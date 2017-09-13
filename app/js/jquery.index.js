( function(){

    $( function(){

        $.each( $( '.site__header' ), function () {
            new Header( $(this) );
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

    } );

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
                    prevButton: _productsPrev
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

} )();