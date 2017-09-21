( function(){

    $( function(){

        $.each( $( '.contact-us' ), function () {
            new ContactUs( $(this) );
        } );

        $.each( $( '.site__header' ), function () {
            new Header( $(this) );
        } );

        $.each( $( '.list-info' ), function () {
            new ListInfo( $( this ) );
        } );

        $.each( $( '.mobile-menu' ), function () {
            new Menu( $( this ) );
        } );

        $.each( $( '.preloader' ), function () {
            new Preloader( $( this ) );
        } );

        $.each( $( '.products' ), function () {
            new Sliders( $( this ) );
        } );

        $.each( $( '.history' ), function () {
            new History( $( this ) );
        } );

        $.each( $( '.hero-slider' ), function () {
            new HeroSlider( $( this ) );
        } );

    } );

    var ContactUs = function ( obj ) {
        var _self = this,
            _obj = obj,
            _checkboxes = obj.find('input[type=checkbox]'),
            _radio = obj.find('input[type=radio]'),
            _wrap = _obj.find('.ginput_container_fileupload'),
            _dataText = _wrap.parent().find('.gfield_description').text(),
            _inputFile = _obj.find('input[type=file]');

        var _onEvents = function() {

                _inputFile.on( {
                    'change': function ( e ) {
                        if( this.files && this.files[0] ){
                            _dataText = this.files[0].name;
                            _wrap.addClass('changing');
                            _wrap.attr('data-text', _dataText);
                        }
                    }
                } );

            },
            _construct = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();

                _checkboxes.each(function () {
                    $(this).parent().addClass('nice-checkbox');
                });
                _radio.each(function () {
                    $(this).parent().addClass('nice-radio');
                });
                _wrap.attr('data-text', _dataText);
            };

        //public methods

        _construct()
    };

    var Header = function ( obj ) {
        var _self = this,
            _obj = obj,
            _lastPos,
            _canUseSmoothScroll = true,
            _indexHero = $( '.hero' ),
            _window = $( window );

        var _onEvents = function() {

                _window.on( {
                    'DOMMouseScroll': function ( e ) {
                        var delta = e.originalEvent.detail;
                        if ( delta ) {
                            var direction = ( delta > 0 ) ? 1 : -1;
                            _checkScroll( direction );
                        }
                    },
                    'mousewheel': function ( e ) {
                        var delta = e.originalEvent.wheelDelta;
                        if ( delta ) {
                            var direction = ( delta > 0 ) ? -1 : 1;
                            _checkScroll( direction );
                        }
                    },
                    'touchmove': function ( e ) {
                        var currentPos = e.originalEvent.touches[0].clientY;
                        if ( currentPos > _lastPos ) {
                            _checkScroll( -1 );
                        } else if ( currentPos < _lastPos ) {
                            _checkScroll( 1 );
                        }
                        _lastPos = currentPos;
                    },
                    'keydown': function ( e ) {
                        switch( e.which ) {

                            case 32:
                                _checkScroll( 1 );
                                break;
                            case 33:
                                _checkScroll( -1 );
                                break;
                            case 34 :
                                _checkScroll( 1 );
                                break;
                            case 35 :
                                _checkScroll( 1 );
                                break;
                            case 36 :
                                _checkScroll( -1 );
                                break;
                            case 38:
                                _checkScroll( -1 );
                                break;
                            case 40:
                                _checkScroll( 1 );
                                break;

                            default:
                                return;
                        }
                    },
                    'scroll': function() {

                        var space = 340;

                        if ( _indexHero.length > 0 ) {
                            space = _indexHero.outerHeight();
                        }

                        if ( _window.scrollTop() > space ) {
                            _obj.addClass( 'fixed' );
                        } else {
                            _obj.removeClass( 'fixed' );
                        }

                    }
                } );

            },
            _checkScroll = function( direction ){
                if( direction > 0 && !_obj.hasClass( 'hidden' ) && _window.scrollTop() > _obj.outerHeight() && _canUseSmoothScroll ) {
                    _hideHeader();
                } else if( direction < 0 && _obj.hasClass( 'hidden' ) && _canUseSmoothScroll ) {
                    _showHeader();
                }
            },
            _showHeader = function () {
                _obj.removeClass( 'hidden' );
            },
            _hideHeader = function () {
                _obj.addClass( 'hidden' );
            },
            _construct = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();
            };

        //public methods
        _self.setCanUseScroll = function ( param ) {
            _canUseSmoothScroll = param;
        };

        _construct()
    };

    var ListInfo = function( obj ){

        //private properties
        var _obj = obj,
            _btn = _obj.find('.list-info__menu-title'),
            _wrap = _obj.find('nav'),
            _navItems = _wrap.find('a'),
            _content = _obj.find('.list-info__content'),
            _path = _obj.data( 'path' ),
            _request = new XMLHttpRequest();

        //private methods
        var _constructor = function(){
                _onEvents();
            },
            _onEvents = function(){

                window.addEventListener("popstate", function(e) {
                    // Передаем текущий URL
                    // getContent(location.pathname, false);
                    // console.log(e);
                    // _writeNewContent(e.state.html);
                });
            
                _btn.on( 'click', function() {

                    if (!_wrap.hasClass('open')) {
                        _openMenu();
                    } else {
                        _closeMenu();
                    }

                } );

                _navItems.on( 'click', function(e) {

                    e.preventDefault();
                    var curElem = $(this),
                        curPostData = curElem.data('post');

                    if ( !curElem.hasClass('active') ) {
                        _navItems.attr('class', '');
                        curElem.addClass('active');
                        //
                        // _getContext(curPostData);

                        _ajaxRequest(curPostData);
                        _closeMenu();

                        // _getContext(curPostData);
                    }
                    // return false;
                } );

            },
            _ajaxRequest = function(postData) {

                _request.abort();
                _request = $.ajax({
                    url: _path,
                    data: { action: 'post', data: postData },
                    dataType: 'html',
                    timeout: 20000,
                    type: "get",
                    success: function (msg) {

                        _writeNewContent(msg);

                        history.pushState({html: msg}, null, null);
                    },
                    error: function ( XMLHttpRequest ) {
                        if( XMLHttpRequest.statusText != "abort" ) {
                            alert( 'Error!' );
                        }
                    }
                });

            },
            _getContext = function(url){
                $.get(url)
                    .done(function( data ) {

                        // Updating Content on Page
                        _writeNewContent(data);

                        history.pushState(null, null, url);

                    });
            },
            _openMenu = function(){
                var winScrollTop = $(window).scrollTop(),
                    positionTop = _btn.outerHeight(),
                    heightElem = $(window).height() - _btn.offset().top - positionTop + winScrollTop;

                _wrap.addClass('open');
                _wrap.css({
                    'height': heightElem + 'px',
                    'top': positionTop + 'px'
                });

                $('html').css({ 'overflow': 'hidden' });

                $( '.site__header' )[0].obj.setCanUseScroll( true );
            },
            _closeMenu = function(){
                _wrap.removeClass('open');
                _wrap.attr('style', '');
                $('html').attr('style', '');

                $( '.site__header' )[0].obj.setCanUseScroll( false );
            },
            _writeNewContent = function(html){
                _content.html('');
                _content.html(html);
            };

        //public properties

        //public methods

        _constructor();

    };

    var Menu = function( obj ){

        //private properties
        var _obj = obj,
            _btn = $( '.mobile-menu-btn' ),
            _html = $( 'html' );

        //private methods
        var _constructor = function(){
                _onEvents();
            },
            _onEvents = function(){

                _btn.on( 'click', function() {

                    if ( $( this).hasClass( 'close' ) ){
                        _closeMenu();
                    } else {
                        _openMenu();
                    }

                } );

            },
            _openMenu = function(){
                _btn.addClass( 'close' );
                _obj.addClass( 'visible' );
                _html.css( 'overflow-y', 'hidden' );

                $( '.site__header' )[0].obj.setCanUseScroll( true );
            },
            _closeMenu = function(){
                _btn.removeClass( 'close' );
                _obj.removeClass( 'visible' );
                _html.removeAttr( 'style' );

                $( '.site__header' )[0].obj.setCanUseScroll( false );
            };

        //public properties

        //public methods

        _constructor();

    };

    var Preloader = function ( obj ) {

        var _obj = obj,
            _loader = _obj.find( '.preloader__bar' ),
            _flag = false,
            _loadFlag = false,
            _delay = _obj.data( 'delay' ),
            _window = $( window );

        var _onEvents = function () {

                _window.on( {
                    load: function() {

                        _loadFlag = true;

                    }
                } );

            },
            _init = function() {
                _onEvents();
                _loadBar();
            },
            _loadBar = function (){

                var firstLoadVal = Math.floor(Math.random() * 10) + 1,
                    curValue = firstLoadVal;

                _loader.animate({'width':''+firstLoadVal+'%'}, 200);

                setTimeout(function () {

                    setInterval(function () {

                        var loadVal = Math.floor(Math.random() * 90) + 1;

                        if(loadVal<90 && loadVal>curValue){

                            curValue = loadVal;

                            _loader.animate({'width':''+loadVal+'%'}, 200);

                        }

                    }, 500);

                }, 1000);

                setInterval(function (){
                    if(_loadFlag){

                        _loader.animate({'width': 100+'%'}, 200);

                        _obj.css( {
                            'opacity': 0,
                            'visibility': 'hidden'
                        } );

                        setTimeout(function () {
                            _obj.remove();
                        }, 650);

                        _flag = true

                    }
                }, 500);


            };

        _init();
    };

    var Sliders = function( obj ) {

        //private properties
        var _obj = obj,
            _productsSwiper = _obj.find( '.products__swiper' ),
            _productsPrev = _obj.find( '.products__prev' ),
            _productsNext = _obj.find( '.products__next' ),
            _products,
            _window = $( window );

        //private methods
        var _initSlider = function() {

                _products = new Swiper ( _productsSwiper, {
                    autoplay: false,
                    speed: 500,
                    effect: 'slide',
                    slidesPerView: 4,
                    loop: true,
                    nextButton: _productsNext,
                    prevButton: _productsPrev,
                    breakpoints: {
                        767: {
                            slidesPerView: 1
                        },
                        1199: {
                            slidesPerView: 2
                        }
                    }
                } );

                // pagination: _caseMainSliderPagination

            },
            _onEvent = function() {

            },
            _init = function() {
                _onEvent();
                _initSlider ();
            };

        //public properties

        //public methods

        _init();
    };

    var History = function( obj ) {

        //private properties
        var _obj = obj,
            _years = _obj.find( '.history__years' ),
            _yearsLine = _years.find( '.history__years-line' ),
            _yearsPoint = _yearsLine.find('.history__years-point'),
            _yearsList = _years.find( '.history__years-list' ),
            _contentSlider = _obj.find( '.history__content' ),
            _sliderItems = _contentSlider.find('.swiper-slide'),
            _swiper = null,
            _window = $( window );

        //private methods
        var _initSlider = function() {

                _swiper = new Swiper(_contentSlider, {
                    pagination: _yearsList,
                    paginationClickable: true,
                    paginationBulletRender: function (index, className) {
                        return '<span class="history__years-item ' + className + '">' + _sliderItems.eq(index).data('year') + '</span>';
                    },
                    onSlideChangeStart: function (e) {
                        _sliding($(e.bullets[e.activeIndex]));
                    }
                });

            },
            _onEvent = function() {

                _obj.on('click', '.history__years-item', function() {
                    var activeElem = $(this);
                    _sliding(activeElem);
                });

                $(window).on({
                    'resize': function () {
                        _sliding(_obj.find('.swiper-pagination-bullet-active'));
                    }
                });

            },
            _sliding = function(elem) {
                _yearsPoint.css({
                    'left': (elem.offset().left - _yearsLine.offset().left) + 'px'
                });
            },
            _init = function() {
                _onEvent();
                _initSlider ();
            };

        //public properties

        //public methods

        _init();
    };

    var HeroSlider = function( obj ) {

        //private properties
        var _obj = obj,
            _slider = _obj.find( '.swiper-container' ),
            _pagination = _obj.find( '.swiper-pagination' ),
            _swiper = null;

        //private methods
        var _initSlider = function() {
                console.log(111);
                _swiper = new Swiper ( _slider, {
                    autoplay: 3000,
                    speed: 500,
                    effect: 'fade',
                    loop: true,
                    pagination: _pagination,
                    paginationClickable: true
                } );

            },
            _onEvent = function() {

            },
            _init = function() {
                _onEvent();
                _initSlider ();
            };

        //public properties

        //public methods

        _init();
    };

} )();