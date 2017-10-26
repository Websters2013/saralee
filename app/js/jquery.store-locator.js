( function(){

    $( function(){

        $.each( $( '.store-locator' ), function () {
            new StoreLocator( $(this) );
        } );

    } );

    var StoreLocator = function ( obj ) {
        var _obj = obj,
            _form = _obj.find( '.store-locator__form' ),
            _formSearchBtn = _form.find( 'button' ),
            _zipField = _obj.find( 'input[name=zip]' ),
            _groupSelect = _obj.find( 'select[name=group]' ),
            _upcSelect = _obj.find( 'select[name=upc]' ),
            _milesSelect = _obj.find( 'select[name=miles]' ),
            _storeLocatorList = _obj.find( '.store-locator__list' ),
            _storeMap = _obj.find( '.store-locator__map' ),
            _sliderContainer = _storeLocatorList.find( '.swiper-container' ),
            _emptyMessage = _obj.find( '.store-locator__message' ),
            _messageMiles = _emptyMessage.find( 'store-locator__message-miles' ),
            _messageZip = _emptyMessage.find( 'store-locator__message-zip' ),
            _body = $( 'html, body' ),
            _window = $( window ),
            _request = new XMLHttpRequest(),
            _map = null,
            _markersArray = [],
            _windowArray = [],
            _controlNewAdd = true,
            _initSliderFlag = false;

        var _onEvents = function() {

                _groupSelect.on( 'change', function () {
                    _ajaxSubCatalogRequest();
                } );

                _form.on( 'submit', function () {

                    _storeLocatorList.addClass( 'loader' );

                    _createNewList();

                    if ( _window.outerWidth <= 768 ){

                        _body.animate( {
                            scrollTop: _storeLocatorList.offset().top
                        }, 600);

                    }

                    return false;

                } );

                _storeLocatorList.on( 'click', '.store-locator__list-item', function () {

                    var curElem = $( this ),
                        curId = curElem.data( 'id' ),
                        curAddress = curElem.data( 'address' ),
                        curNum = curElem.data( 'num' ),
                        curName = curElem.data( 'name' ),
                        curCity = curElem.data( 'city' ),
                        curState = curElem.data( 'state' ),
                        curZip = curElem.data( 'zip' );

                    _storeLocatorList.find( '.store-locator__list-item' ).removeClass( 'active' );

                    curElem.addClass( 'active' );

                    _clearMarkers();

                    _addMark( curAddress, curName, curCity, curState, curZip, curNum, curId, true );

                    _map = new google.maps.Map( _storeMap[ 0 ], {
                        zoom: 16
                    } );

                    _scrollTop();

                } );

            },
            _scrollTop = function () {

                _body.animate( {
                    scrollTop: _storeMap.offset().top
                }, 600);

            },
            _addMark = function ( address, name, city, state, zip, num, id, open ) {

                _markersArray = [];

                var gcc = new google.maps.Geocoder(),
                    number = num + 1;

                gcc.geocode( { address:address, componentRestrictions: { country: 'USA', postalCode: zip } },function( results, status ){

                    console.log( results )

                    if ( status == google.maps.GeocoderStatus.OK ) {

                        _map.setCenter( results[0].geometry.location );

                        var marker = new google.maps.Marker( {
                            map: _map,
                            position: results[0].geometry.location,
                            icon: {
                                url: window.location.origin+'/wp-content/themes/saralle/assets/img/strore-mark-'+ number +'.png',
                                // url: 'img/strore-mark-'+ number +'.png',
                                size: new google.maps.Size( 62, 78 )
                            }
                        } );

                        marker.id = id;

                        marker.info = new google.maps.InfoWindow( {
                            content: '<div class="map-place">' +
                            '<p>'+ name +'</p>'+
                            '<p>'+ address +'</p>'+
                            '<p>'+ city +', '+ state +' '+ zip +'</p>'+
                            '</div>'
                        });

                        if ( open ){
                            marker.info.open( _map, marker );
                        }

                        _markersArray.push( marker );

                        // console.log( _markersArray );

                        marker.addListener( 'click', function() {

                            _storeLocatorList.find( '.store-locator__list-item' ).removeClass( 'active' );
                            _storeLocatorList.find( '.store-locator__list-item' ).filter( '[data-id='+ $( this )[0].id +']' ).addClass( 'active' ).trigger( 'click' );

                            marker.info.open( _map, marker );

                        } );

                    }
                } );

            },
            _ajaxListRequest = function ( page ) {

                _request = $.ajax( {
                    url: $( 'body' ).data('action'),
                    data:{
                        action: 'locator',
                        upc: _upcSelect.find( 'option:selected' ).val(),
                        zip: _zipField.val(),
                        miles: _milesSelect.find( 'option:selected' ).val(),
                        page: page
                    },
                    dataType: 'json',
                    timeout: 20000,
                    type: 'GET',
                    success: function ( data ) {

                        _appendInStoreLocatesSlides( data, page );

                    },
                    error: function ( XMLHttpRequest ) {
                        if ( XMLHttpRequest.statusText != "abort" ) {
                            console.log( 'err' );
                        }
                    }
                } );

            },
            _ajaxSubCatalogRequest = function () {

                var group = _groupSelect.find( 'option:selected' ).val();

                _form.find( '.dependent' ).addClass( 'hide' );

                if ( group != 0 ) {

                    _request = $.ajax( {
                        url: $( 'body' ).data( 'action' ),
                        data:{
                            action: 'locator',
                            categories: _groupSelect.find( 'option:selected' ).val()
                        },
                        dataType: 'json',
                        timeout: 20000,
                        type: 'GET',
                        success: function ( data ) {

                            _createUpcSelect( data );

                        },
                        error: function ( XMLHttpRequest ) {
                            if ( XMLHttpRequest.statusText != "abort" ) {
                                console.log( 'err' );
                            }
                        }
                    } );

                }

            },
            _appendInStoreLocatesList = function ( data, page ) {

                var curPage = page,
                    sliderSlide = _sliderContainer.find( '.swiper-slide' ).eq( curPage - 1 ).filter( '.empty' ),
                    sliderControl = _storeLocatorList.find( '.store-locator__list-control' );

                if ( data.products.length > 0 ) {

                    $.each( data.products, function ( i ) {

                        var curItem = $( this )[0],
                            storeID = curItem.storeID,
                            phone = curItem.phone,
                            address = curItem.address,
                            distance = curItem.distance,
                            city = curItem.city,
                            name = curItem.name,
                            state = curItem.state,
                            zip = curItem.zip,
                            storeListItem;

                        storeListItem = $( '<div class="store-locator__list-item new" data-id="'+ storeID +'" data-address="'+ address +'" data-num="'+ i +'" data-name="'+ name +'" data-state="'+ state +'" data-city="'+ city +'" data-zip="'+ zip +'"><div class="store-locator__info"><span>'+ ( i + 1 ) +'</span>'+
                            '<p>'+ distance +' Miles</p></div><div class="store-locator__content"><p><strong>'+ name +'</strong></p>'+
                            '<p>'+ address +'</p><p><a href="tel:'+ phone +'">'+ phone +'</a></p>'+
                            '<p>'+
                            // '<a href="#">Hours</a> | '+
                            '<a href="http://maps.google.com/maps?q='+ address +' '+ city +','+ state +'">Directions</a></p></div></div>' );

                        sliderSlide.append( storeListItem ).removeClass( 'empty' );

                        _addMark( address, name, city, state, zip, i, storeID, false );

                    } );

                    var newItem = sliderSlide.find( '.new' );

                    newItem.each( function ( i ) {

                        var curItem = $( this );

                        _showNewItems( curItem, i );

                    } );

                    _storeLocatorList.removeClass( 'loader' );

                    if ( data.products.length > 1 ) {

                        setTimeout( function () {
                            _centerMap();
                        }, 1000 );

                    } else if ( data.products.length == 1 ) {

                        _storeLocatorList.find( '.swiper-slide-active' ).find( '.store-locator__list-item' ).addClass( 'active' ).trigger( 'click' );

                    }

                    _scrollTop();

                } else if ( data.products.length == 0 ) {

                    sliderControl.remove();

                    _markersArray = [];

                    _map = new google.maps.Map( _storeMap[ 0 ], {
                        zoom: 10,
                        center: {lat: 41.8957786, lng: -87.7869281}
                    } );

                    _emptyMessage.addClass( 'show' );

                    _messageMiles.text( _milesSelect.find( 'option:checked' ).text() );
                    _messageZip.text( _zipField.val() );

                }

                _storeLocatorList.height( _sliderContainer.outerHeight() + sliderControl.outerHeight() );

                setTimeout( function () {
                    google.maps.event.trigger( _map, "resize");
                }, 500 );

            },
            _appendInStoreLocatesSlides = function ( data, page ) {

                var sliderWrap = _storeLocatorList.find( '.swiper-wrapper' ),
                    sliderControl = $( '<div class="store-locator__list-control"><a href="#" class="store-locator__swiper-prev">Prev</a><span>Showing page <i class="store-locator__cur-page"></i> of <i class="store-locator__page"></i></span><a href="#" class="store-locator__swiper-next">next</a></div>' ),
                    curPage = page;

                if ( page == 1 && data.pagination > 1 ) {

                    for ( var n = 1; n <= data.pagination; n++ ){

                        var sliderSlide = $( '<div class="swiper-slide empty"></div>' );

                        sliderWrap.append( sliderSlide );

                    }

                    if ( _controlNewAdd ) {
                        _storeLocatorList.append( sliderControl );

                        var numCurPage = sliderControl.find( '.store-locator__cur-page' ),
                            numPage = sliderControl.find( '.store-locator__page' );

                        numCurPage.html( page );
                        numPage.html( data.pagination );

                        _controlNewAdd = false;
                    } else {

                        var numCurPage = _storeLocatorList.find( '.store-locator__cur-page' );
                        numCurPage.html( page );

                    };

                    _initSlider();

                } else if ( page == 1 ) {

                    var sliderSlide = $( '<div class="swiper-slide empty"></div>' );

                    sliderWrap.append( sliderSlide );

                } else if ( page > 1 ) {

                    var numCurPage = _storeLocatorList.find( '.store-locator__cur-page' );
                    numCurPage.html( page );

                }

                _appendInStoreLocatesList( data, curPage );

            },
            _centerMap = function () {

                var latlngbounds = new google.maps.LatLngBounds();

                 for ( var i=0; i < _markersArray.length; i++ ){
                    latlngbounds.extend( _markersArray[ i ].position );
                 }

                 // console.log( latlngbounds );

                 _map.setCenter( latlngbounds.getCenter(), _map.fitBounds( latlngbounds ) );

            },
            _clearMarkers = function () {

            // console.log( 'clear:'+ _markersArray )

                if ( _markersArray ) {
                    for ( var i in _markersArray ) {
                        _markersArray[ i ].setMap(null);
                    }
                }
                if ( _windowArray ) {
                    for ( var i in _windowArray) {
                        _windowArray[ i ].close();
                    }
                }

            },
            _createNewList = function () {

                _controlNewAdd = true;

                var sliderWrap = _sliderContainer.find( '.swiper-wrapper' );

                _storeLocatorList.height( _storeLocatorList.outerHeight() );

                if ( _initSliderFlag ) {
                    _sliderContainer[0].swiper.destroy( true, true );
                    _initSliderFlag = false;
                }

                sliderWrap.empty();

                _emptyMessage.removeClass( 'show' );

                _clearMarkers();
                _ajaxListRequest( 1 );

            },
            _createStoreLocatesListWrap = function () {

                var sliderWrap = $( '<div class="swiper-wrapper"></div>' );

                _sliderContainer.append( sliderWrap );

                _ajaxListRequest( 1 );
                _mapInit();

            },
            _createUpcSelect = function ( data ) {

                var options = data;

                _upcSelect.empty();
                _upcSelect.append( '<option value="0" selected="selected">All Products</option>' );

                _upcSelect.prev( '.websters-select__item' ).text( 'All Products' );

                $.each( options.subcategories, function () {

                    var curItem = $( this )[0],
                        name = curItem.name,
                        value = curItem.upc;

                    _upcSelect.append( '<option value="'+ value +'">'+ name +'</option>' );

                } );

                _form.find( '.dependent' ).removeClass( 'hide' );

            },
            _mapInit = function () {

                _map = new google.maps.Map( _storeMap[ 0 ], {
                    zoom: 10,
                    center: {lat: 41.8957786, lng: -87.7869281},
                    mapTypeId: 'roadmap',
                    scrollwheel: false,
                    draggable: true,
                    zoomControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false
                } );

            },
            _initSlider = function ()  {

                var storeLocatorPrev = _storeLocatorList.find( '.store-locator__swiper-prev' ),
                    storeLocatorNext = _storeLocatorList.find( '.store-locator__swiper-next' ),
                    storeLocatorSlide = _sliderContainer.find( '.swiper-slide' ),
                    storeLocator;

                storeLocator = new Swiper ( _sliderContainer, {
                    autoplay: false,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 1,
                    loop: false,
                    nextButton: storeLocatorNext,
                    prevButton: storeLocatorPrev,
                    onSlideChangeStart: function () {

                        _storeLocatorList.addClass( 'not-toched' );

                        _clearMarkers();
                        _ajaxListRequest( storeLocatorSlide.filter( '.swiper-slide-active' ).index() + 1 );
                        _storeLocatorList.find( '.active' ).removeClass( 'active' );

                        _storeLocatorList.addClass( 'loader' );

                    },
                    onSlideChangeEnd: function () {

                        _storeLocatorList.removeClass( 'not-toched' );

                    }
                } );

                _initSliderFlag = true;

            },
            _showNewItems = function ( item, index ) {

                var curItem = item;

                setTimeout( function() {
                    curItem.removeClass( 'new' );
                }, 100 * index );

            },
            _init = function() {
                _createStoreLocatesListWrap();
                _onEvents();
            };

        //public methods

        _init();

    };

} )();