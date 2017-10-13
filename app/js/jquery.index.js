( function(){

    $( function(){

        $.each( $( '.contact-us' ), function () {
            new ContactUs( $(this) );
        } );

        $.each( $( '.dropdown' ), function () {
            new Dropdown( $(this) );
        } );

        $.each( $( '.site__header' ), function () {
            new Header( $(this) );
        } );

        $.each( $( '.list-info' ), function () {
            new ListInfo( $( this ) );
        } );

        $.each( $( '.faq' ), function () {
            new Faq( $( this ) );
        } );

        $.each( $( '.mobile-menu' ), function () {
            new Menu( $( this ) );
        } );

        $.each( $( '.preloader' ), function () {
            new Preloader( $( this ) );
        } );

        $.each( $( '.product' ), function () {
            new Product( $( this ) );
        } );

        $.each( $( '.products' ), function () {
            new Sliders( $( this ) );
        } );

        $.each( $( '.tab' ), function () {
            new Tab( $( this ) );
        } );

        $.each( $( '.history' ), function () {
            new History( $( this ) );
        } );

        $.each( $( '.hero-slider' ), function () {
            new HeroSlider( $( this ) );
        } );

        $.each( $( '.share' ), function () {
            new Social( $( this ) );
        } );

        $.each( $( '.menu' ), function () {
            new SubMenu( $( this ) );
        } );

        $.each( $( '.search' ), function () {
            new Search( $( this ) );
        } );

        $.each( $( '.rate' ), function () {
            new Rate( $( this ) );
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

    var Dropdown = function ( obj ) {
        var _self = this,
            _obj = obj,
            _titles = _obj.find('.dropdown__title'),
            _contents = _obj.find('.dropdown__content');

        var _onEvents = function() {

                _titles.on( {
                    'click': function () {
                       var curElem = $(this);

                        if ( !curElem.hasClass('active') ) {
                            _titles.removeClass('active');
                            curElem.addClass('active');
                            _contents.slideUp();
                            $(this).next().slideDown();
                        }
                    }
                } );

            },
            _show = function () {
                _obj.removeClass( 'hidden' );
            },
            _hide = function () {
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
            _path = $('body').data( 'action' ),
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

    var Faq = function( obj ){

        //private properties
        var _obj = obj,
            _btn = _obj.find('.faq__menu-title'),
            _wrap = _obj.find('nav'),
            _navItems = _wrap.find('a'),
            _content = _obj.find('.faq__content'),
            _path = $('body').data( 'action' ),
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

    var SubMenu = function( obj ){

        //private properties
        var _obj = obj,
            _menuBtn = _obj.find( '.menu__item' ),
            _subMenu = _obj.find( '.menu__subcategory' ),
            _site = $( '.site' ),
            _window = $( window );

        //private methods
        var _init = function(){
                _onEvents();
            },
            _onEvents = function(){

                _site.on(
                    'click', function ( e ) {

                        if ( _subMenu.hasClass( 'show' ) && $( e.target ).closest( _subMenu ).length == 0 && $( e.target ).closest( _menuBtn ).length == 0 ){
                            _closeSubMenu();
                            return false;
                        }

                    }
                );

                _menuBtn.on( 'click', function() {

                    var curBtn = $( this ),
                        curSubMenu = curBtn.next( '.menu__subcategory' );

                    if ( curBtn.next().is( '.menu__subcategory' ) && !curSubMenu.hasClass( 'show' ) && _window.outerWidth() < 1200  ){
                        _openSubMenu( curSubMenu );
                        return false;
                    }

                } );

            },
            _closeSubMenu = function () {

                _subMenu.removeClass( 'show' );
                _subMenu.removeAttr( 'style' );

            },
            _openSubMenu = function( obj ){

                var subMenu = obj;

                subMenu.addClass( 'show' );
                subMenu.height( subMenu.find( 'ul' ).outerHeight() + 20 );

            };

        //public properties

        //public methods

        _init();

    };

    var Search = function( obj ){

        //private properties
        var _obj = obj,
            _form = _obj.find( '.search__form' ),
            _btnOpen = _obj.find( '.search__open-btn' ),
            _site = $( '.site' ),
            _window = $( window );

        //private methods
        var _init = function(){
                _onEvents();
            },
            _onEvents = function(){

                _site.on(
                    'click', function ( e ) {

                        if ( _form.hasClass( 'show' ) && $( e.target ).closest( _form ).length == 0 ){
                            _closeFrame();
                            return false;
                        }

                    }
                );

                _btnOpen.on( 'click', function() {

                    if ( !_form.hasClass( 'show' )  ){
                        _openFrame();
                    } else {
                        _closeFrame();
                    }

                    return false;

                } );

            },
            _closeFrame = function () {

                _form.removeClass( 'show' );

            },
            _openFrame = function(){

                _form.addClass( 'show' );

            };

        //public properties

        //public methods

        _init();

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
            _products;

        //private methods
        var _initSlider = function() {

                if ( _obj.hasClass('products_single') ) {
                    _products = new Swiper ( _productsSwiper, {
                        autoplay: false,
                        speed: 500,
                        effect: 'slide',
                        slidesPerView: 1,
                        loop: true,
                        nextButton: _productsNext,
                        prevButton: _productsPrev
                    } );
                } else {
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
                }

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

    var Product = function( obj ) {

        //private properties
        var _obj = obj,
            _topGallery = _obj.find( '.gallery-top' ),
            _thumbsGallery = _obj.find( '.gallery-thumbs' ),
            _galleryTop, _galleryThumbs;

        //private methods
        var _initSlider = function() {

                _galleryTop = new Swiper( _topGallery, {
                    slidesPerView: 1,
                    onSlideChangeStart: function () {

                        var promoTabsSlide = $( '.gallery-top' ).find( '.swiper-slide' ),
                            curSlide = promoTabsSlide.filter( '.swiper-slide-active' ).index(),
                            promoMainSlide = $( '.gallery-thumbs' ).find( '.swiper-slide' ),
                            promoMainActiveSlide = promoMainSlide.eq( curSlide );

                        promoMainSlide.removeClass( 'active' );
                        promoMainActiveSlide.addClass( 'active' );

                        $( '.gallery-thumbs' )[0].swiper.slideTo( curSlide, 200, false )

                    }
                } );
                _galleryThumbs = new Swiper( _thumbsGallery, {
                    slidesPerView: 3,
                    onInit: function () {

                        var promoTabsSlide = $( '.gallery-thumbs' ).find( '.swiper-slide' );

                        promoTabsSlide.eq( 0 ).addClass( 'active' );

                        promoTabsSlide.on( 'click', function () {

                            var curSlide = +( $( this ).index() );

                            promoTabsSlide.removeClass( 'active' );
                            $( this ).addClass( 'active' );

                            $( '.gallery-top' )[0].swiper.slideTo( curSlide, 200, false );

                            return false;
                        } );

                    },
                    onSlideChangeStart: function () {

                        var promoTabsSlide = $( '.gallery-thumbs' ).find( '.swiper-slide' ),
                            curSlide = +( promoTabsSlide.filter( '.active' ).index() ),
                            curActiveSlide = +( promoTabsSlide.filter( '.swiper-slide-active' ).index() );

                        /*if ( curActiveSlide >= curSlide ){

                        }*/

                        $( '.gallery-top' )[0].swiper.slideTo( curSlide, 200, false );

                    }
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

    var History = function( obj ) {

        //private properties
        var _obj = obj,
            _years = _obj.find( '.history__years' ),
            _contentSlider = _obj.find( '.history__content' ),
            _yearsList = _years.find( '.history__years-list' ),
            _yearNext = _obj.find( '.history__years-next' ),
            _yearPrev = _obj.find( '.history__years-prev' ),
            _swiper, _swiperYearsList;

        //private methods
        var _initSliders = function() {

                _swiper = new Swiper( _contentSlider, {
                    slidesPerView: 1,
                    onSlideChangeStart: function () {

                        var promoTabsSlide = $( '.history__content' ).find( '.swiper-slide' ),
                            curSlide = promoTabsSlide.filter( '.swiper-slide-active' ).index(),
                            promoMainSlide = $( '.history__years-list' ).find( '.swiper-slide' ),
                            promoMainActiveSlide = promoMainSlide.eq( curSlide );

                        promoMainSlide.removeClass( 'swiper-slide-active' );
                        promoMainActiveSlide.addClass( 'swiper-slide-active' );

                        $( '.history__years-list' )[0].swiper.slideTo( curSlide, 200, false )

                    }
                } );

                _swiperYearsList = new Swiper( _yearsList, {
                    slidesPerView: 9,
                    centeredSlides: true,
                    nextButton: _yearNext,
                    prevButton: _yearPrev,
                    onInit: function () {

                        var promoTabsSlide = $( '.history__years-list' ).find( '.swiper-slide' );

                        promoTabsSlide.eq( 0 ).addClass( 'swiper-slide-active' );

                        promoTabsSlide.on( 'click', function () {

                            var curSlide = +( $( this ).index() );

                            promoTabsSlide.removeClass( 'swiper-slide-active' );
                            $( this ).addClass( 'swiper-slide-active' );

                            $( '.history__years-list' )[0].swiper.slideTo( curSlide, 200, false );
                            $( '.history__content' )[0].swiper.slideTo( curSlide, 200, false );

                            return false;
                        } );

                    },
                    onSlideChangeStart: function () {

                        var promoTabsSlide = $( '.history__years-list' ).find( '.swiper-slide' ),
                            curSlide = +( promoTabsSlide.filter( '.swiper-slide-active' ).index() ),
                            curActiveSlide = +( promoTabsSlide.filter( '.swiper-slide-active' ).index() );

                        $( '.history__content' )[0].swiper.slideTo( curSlide, 200, false );

                    }
                } );

            },
            _onEvent = function() {

            },
            _init = function() {
                _onEvent();
                _initSliders ();
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

    var Tab = function( obj ) {

        //private properties
        var _obj = obj,
            _controlsWrap = _obj.find('.tab__controls'),
            _controls = _controlsWrap.find('.tab__controls-item'),
            _activeControl = _controlsWrap.find('.active'),
            _contentsWrap = _obj.find('.tab__content'),
            _contents = _contentsWrap.find('.tab__content-item');
        
        //private methods
        var _onEvent = function() {

                _controls.on({
                    'click': function () {
                        var curItem = $(this);

                        if ( !curItem.hasClass('active') ) {
                            _controls.removeClass('active');
                            curItem.addClass('active');
                            _showActiveContent(curItem.index());
                        }
                    }
                });

                $(window).on({
                    'load': function () {
                        _activeControl.removeClass('active');
                        _activeControl.trigger('click');
                    }
                });

            },
            _showActiveContent = function(activeIndex) {
                _contents.removeClass('active');
                _contents.eq(activeIndex).addClass('active');
                _contentsWrap.css({ 'height': _contents.eq(activeIndex).outerHeight() + 'px' });
            },
            _init = function() {
                _onEvent();
            };

        //public properties

        //public methods

        _init();
    };

    var Rate = function( obj ) {

        //private properties
        var _obj = obj,
            _rateNumber = _obj.prev( 'span' ),
            _rateFrame = _obj.find( '.FSR_container_vote' ),
            _rateItemSpan = _rateFrame.find( 'span' ),
            _rateItemLabel = _rateFrame.find( 'label' );

        //private methods
        var _onEvent = function() {

                _rateItemSpan.on( 'click', function(){
                    _rate();
                } );

                _rateItemLabel.on( 'click', function(){
                    _rate();
                } );

            },
            _rate = function () {

                var newRateFrame = _rateFrame.find( '.FSR_container' ),
                    rateCalculate = newRateFrame.attr( 'data-rate' );

                    if( rateCalculate === undefined ) {
                        setTimeout(function () {
                            _rate();

                        }, 500);
                    } else {
                        _rateNumber.html( parseFloat(rateCalculate).toFixed(1) +'/5' );
                    }

            },
            _loadRate = function () {

                var rateContainer = _obj.find('.FSR_container'),
                    rateContainerVote = _obj.find('.FSR_container_vote'),
                    rateCalculate = rateContainer.attr( 'data-rate' ),
                    rateCalculateVote = rateContainerVote.attr( 'data-rate' );

                console.log( rateCalculate );

                if( rateCalculate === undefined && rateCalculateVote === undefined) {
                    setTimeout(function () {
                        _loadRate();
                    }, 500);
                } else if( rateCalculate != undefined ) {
                    _rateNumber.html( parseFloat(rateCalculate).toFixed(1) +'/5' );
                } else if( rateCalculateVote != undefined ) {
                    _rateNumber.html( parseFloat(rateCalculateVote).toFixed(1) +'/5' );
                }

            },
            _init = function() {
                _loadRate();
                _onEvent();
            };

        //public properties

        //public methods

        _init();
    };

    var Social = function (obj) {
        var _obj = obj,
        _socialButton = _obj.find('.social__item');

        //private methods
        var _onEvent = function() {
            _socialButton.on({
                'click': function (event) {
                    var curItem = $(this);
                    event.preventDefault();
                    event.stopPropagation();
                    $('.et_social_sidebar_networks .et_social_icons_container').find('a[data-social_name='+curItem.attr('data-social')+']').trigger( "click" );
                }
            });
        },
        _init = function() {
            _onEvent();
        };


        _init();
    }

} )();