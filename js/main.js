var application = (function($, _window){
    var app = {},

        deviceAgent = navigator.userAgent.toLowerCase(),
        overlayTarget = '',
        authSlider,
        salonsSlider,
        map, placemark,
        subscribeResult = '',
        menuWidth = 0,

        hasPlaceholderSupport = function() {
            var input = document.createElement('input');
            return ('placeholder' in input);
        },

        makeCover = function(image, opts){
            'use strict';

            // set default options
            opts.watchResize = (opts.watchResize !== false);
            opts.alignX = opts.alignX || 'center';
            opts.alignY = opts.alignY || 'middle';

            /*if (!(image instanceof HTMLImageElement)) {
             throw new Error('From imgCoverEffect(): Element passed as a parameter is not an instance of HTMLImageElement.');
             }*/

            if (typeof opts.watchResize !== 'boolean') {
                throw new Error('From imgCoverEffect(): "watchResize" property must be set to a Boolean when the option is specified.');
            }

            if (!image.parentNode) {
                throw new Error('From imgCoverEffect(): passed HTMLImageElement has no parent DOM element.');
            }

            var parent = image.parentNode;          
            var lastParentWidth = 0;
            var lastParentHeight = 0;
            var currParentWidth = 0;
            var currParentHeight = 0;
            var parentAspect = 0;
            var imgAspect = 0;
            var isIElt9 = (image.naturalWidth === undefined);  // detect IE<9 where naturalWidth/naturalHeight is unsupported
            var resizeImg = function () {
                // set DOM resize watcher on the parent element
                if (opts.watchResize === true) {
                    requestAnimationFrame(resizeImg);
                }

                if (!imgAspect) {
                    imgAspect = (!isIElt9) ? (image.naturalWidth / image.naturalHeight) : (image.width / image.height);
                }

                currParentWidth = parent.clientWidth;
                currParentHeight = parent.clientHeight;
                parentAspect = currParentWidth / currParentHeight;

                // check if parent was resized and the image needs to adjust
                if ((currParentWidth !== lastParentWidth) || (currParentHeight !== lastParentHeight)) {

                    // set image size
                    if (parentAspect >= imgAspect) {
                        image.width = currParentWidth;
                        image.height = image.width / imgAspect;
                    } else {
                        image.width = currParentHeight * imgAspect;
                        image.height = currParentHeight;
                    }

                    lastParentWidth = currParentWidth;
                    lastParentHeight = currParentHeight;

                    // set horizontal alignment
                    if (String(opts.alignX).toLowerCase() === 'left') {
                        image.style.left = 0;
                    } else if (String(opts.alignX).toLowerCase() === 'center') {
                        image.style.left = (currParentWidth - image.width) / 2 + 'px';
                    } else if (String(opts.alignX).toLowerCase() === 'right') {
                        image.style.left = currParentWidth - image.width + 'px';
                    } else {
                        throw new Error('From imgCoverEffect(): Unsupported horizontal align value. ' +
                            'Property "alignX" can only be set to one of the following values: "left", "center", or "right".');
                    }

                    // set vertical alignment
                    if (String(opts.alignY).toLowerCase() === 'top') {
                        image.style.top = 0;
                    } else if (String(opts.alignY).toLowerCase() === 'middle') {
                        image.style.top = (currParentHeight - image.height) / 2 + 'px';
                    } else if (String(opts.alignY).toLowerCase() === 'bottom') {
                        image.style.top = currParentHeight - image.height + 'px';
                    } else {
                        throw new Error('From imgCoverEffect(): Unsupported vertical align value. ' +
                            'Property "alignY" can only be set to one of the following values: "top", "middle", or "bottom".');
                    }
                }
            };


            // set default styles
            parent.style.overflow = 'hidden';
            parent.style.position = 'relative'; // to apply overflow with absolutely positioned image child element, can be also set to 'absolute' or 'fixed' if needed
            image.style.position = 'absolute';
            image.style.top = 0;
            image.style.left = 0;
            //image.style.zIndex = -1;

            // set events
            if ((!isIElt9 && image.naturalWidth && image.naturalHeight) || (isIElt9 && image.width && image.height)) {
                resizeImg();
            } else {
                if (image.addEventListener) {
                    image.addEventListener('load', resizeImg, false);
                } else if (image.attachEvent) {
                    image.attachEvent('onload', resizeImg);
                }
            }
        },

		makeCoverLinked = function(image, opts){
            'use strict';

            // set default options
            opts.watchResize = (opts.watchResize !== false);
            opts.alignX = opts.alignX || 'center';
            opts.alignY = opts.alignY || 'middle';

            /*if (!(image instanceof HTMLImageElement)) {
             throw new Error('From imgCoverEffect(): Element passed as a parameter is not an instance of HTMLImageElement.');
             }*/

            if (typeof opts.watchResize !== 'boolean') {
                throw new Error('From imgCoverEffect(): "watchResize" property must be set to a Boolean when the option is specified.');
            }

            if (!image.parentNode) {
                throw new Error('From imgCoverEffect(): passed HTMLImageElement has no parent DOM element.');
            }

            var parent = image.parentNode;          
            parent = parent.parentNode;          
            var lastParentWidth = 0;
            var lastParentHeight = 0;
            var currParentWidth = 0;
            var currParentHeight = 0;
            var parentAspect = 0;
            var imgAspect = 0;
            var isIElt9 = (image.naturalWidth === undefined);  // detect IE<9 where naturalWidth/naturalHeight is unsupported
            var resizeImg = function () {
                // set DOM resize watcher on the parent element
                if (opts.watchResize === true) {
                    requestAnimationFrame(resizeImg);
                }

                if (!imgAspect) {
                    imgAspect = (!isIElt9) ? (image.naturalWidth / image.naturalHeight) : (image.width / image.height);
                }

                currParentWidth = parent.clientWidth;
                currParentHeight = parent.clientHeight;
                parentAspect = currParentWidth / currParentHeight;

                // check if parent was resized and the image needs to adjust
                if ((currParentWidth !== lastParentWidth) || (currParentHeight !== lastParentHeight)) {

                    // set image size
                    if (parentAspect >= imgAspect) {
                        image.width = currParentWidth;
                        image.height = image.width / imgAspect;
                    } else {
                        image.width = currParentHeight * imgAspect;
                        image.height = currParentHeight;
                    }

                    lastParentWidth = currParentWidth;
                    lastParentHeight = currParentHeight;

                    // set horizontal alignment
                    if (String(opts.alignX).toLowerCase() === 'left') {
                        image.style.left = 0;
                    } else if (String(opts.alignX).toLowerCase() === 'center') {
                        image.style.left = (currParentWidth - image.width) / 2 + 'px';
                    } else if (String(opts.alignX).toLowerCase() === 'right') {
                        image.style.left = currParentWidth - image.width + 'px';
                    } else {
                        throw new Error('From imgCoverEffect(): Unsupported horizontal align value. ' +
                            'Property "alignX" can only be set to one of the following values: "left", "center", or "right".');
                    }

                    // set vertical alignment
                    if (String(opts.alignY).toLowerCase() === 'top') {
                        image.style.top = 0;
                    } else if (String(opts.alignY).toLowerCase() === 'middle') {
                        image.style.top = (currParentHeight - image.height) / 2 + 'px';
                    } else if (String(opts.alignY).toLowerCase() === 'bottom') {
                        image.style.top = currParentHeight - image.height + 'px';
                    } else {
                        throw new Error('From imgCoverEffect(): Unsupported vertical align value. ' +
                            'Property "alignY" can only be set to one of the following values: "top", "middle", or "bottom".');
                    }
                }
            };


            // set default styles
            parent.style.overflow = 'hidden';
            parent.style.position = 'relative'; // to apply overflow with absolutely positioned image child element, can be also set to 'absolute' or 'fixed' if needed
            image.style.position = 'absolute';
            image.style.top = 0;
            image.style.left = 0;
            //image.style.zIndex = -1;

            // set events
            if ((!isIElt9 && image.naturalWidth && image.naturalHeight) || (isIElt9 && image.width && image.height)) {
                resizeImg();
            } else {
                if (image.addEventListener) {
                    image.addEventListener('load', resizeImg, false);
                } else if (image.attachEvent) {
                    image.attachEvent('onload', resizeImg);
                }
            }
        },
		
        getViewport = function() {

            var viewPortWidth;
            var viewPortHeight;

            // the more standards compliant browsers (mozilla/netscape/opera/IE7) use _window.innerWidth and _window.innerHeight
            if (typeof _window.innerWidth != 'undefined') {
                viewPortWidth = _window.innerWidth,
                    viewPortHeight = _window.innerHeight
            }

    // IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
            else if (typeof document.documentElement != 'undefined'
                && typeof document.documentElement.clientWidth !=
                'undefined' && document.documentElement.clientWidth != 0) {
                viewPortWidth = document.documentElement.clientWidth,
                    viewPortHeight = document.documentElement.clientHeight
            }

            // older versions of IE
            else {
                viewPortWidth = document.getElementsByTagName('body')[0].clientWidth,
                    viewPortHeight = document.getElementsByTagName('body')[0].clientHeight
            }
            return [viewPortWidth, viewPortHeight];
        },

        socialShare = function(){
            var $shareLink = $('[data-social-share]');
            if ($shareLink.length) {
                var shareThis = function($target,service){
                    var $dataHolder = $target.closest('.js-share-info-holder');
                    var shareData = {
                        'title': $dataHolder.attr('data-share-title'),
                        'text': $dataHolder.attr('data-share-text'),
                        'image': location.origin + '/upload/sertification/' + $dataHolder.attr('data-share-img'),
                        'shareurl': location.origin + '/share/' + $dataHolder.attr('data-share-id') + '/'
                    };

                    if ($target.attr('data-share-inner') == '1') {
                        shareData = {
                            'title': $dataHolder.attr('data-share-title'),
                            'text': $dataHolder.attr('data-share-text'),
                            'image': $dataHolder.attr('data-share-img'),
                            'shareurl': location.href
                        }
                    }

                    var shareLink = 'http://share.yandex.ru/go.xml?service=' + service + '&url=' + shareData.shareurl;'&link=' + shareData.shareurl;
                    shareLink += '&title=' + shareData.title + '&description=' + shareData.text + '&image=' +shareData.image;

                    if (service=='twitter') { shareLink = 'http://share.yandex.ru/go.xml?service=' + service + '&url=' + shareData.shareurl + '&title='+shareData.title; }
                    _window.open(shareLink,'','toolbar=0,status=0,width=626,height=436');
                };

                $shareLink.click(function(e){
                    var $target = $(e.target);
                    var service = $target.attr('data-social-share');
                    if (service) { shareThis($target,service); }
                });
            }
        },

        fancyDefaultSettings = {
            padding: [30, 20, 20, 20],
            wrapCSS: 'arteva-popup',
            tpl: {
                closeBtn: '<div class="fancybox__close"><a class="fbx__close" href="#">&nbsp;</a></div>'
            },
            minWidth: 380,
            openEffect  : 'drop',
            closeEffect : 'drop',
            nextEffect  : 'elastic',
            prevEffect  : 'elastic'
        };

    app.vp = getViewport();
    app.vpHeight = app.vp[1];
    app.vpWidth = app.vp[0];
    app.mobile = device.mobile();
    app.itemId = '';
    app.userId = '';
    app.itemCount = undefined;
    app.init = function(){

        if (app.vpWidth < 642 && device.tablet()) {
            app.mobile = true;
            $('html').removeClass('tablet').addClass('mobile');
        } else {
            if (device.tablet()) {
                if ($('.index-content-wrapper').length) {
                    $('meta[name="viewport"]').attr('content','width=1200');
                } else {
                    $('meta[name="viewport"]').attr('content','width=1050');
                    $('body').css('min-width', '1030px');
                }
            }
        }

        $('.top-nav').find('.top-nav-list').find('>li').each(function(idx, elt){
            menuWidth = menuWidth + $(elt).outerWidth(true);
        });

        $('.top-nav-sublist-cnt').width(menuWidth - 20);

        /*requestAnimationFrame polyfill*/
        (function () {
            var lastTime = 0;
            var vendors = ['ms', 'moz', 'webkit', 'o'];
            for (var x = 0; x < vendors.length && !_window.requestAnimationFrame; ++x) {
                _window.requestAnimationFrame = _window[vendors[x] + 'RequestAnimationFrame'];
                _window.cancelAnimationFrame = _window[vendors[x] + 'CancelAnimationFrame']
                    || _window[vendors[x] + 'CancelRequestAnimationFrame'];
            }

            if (!_window.requestAnimationFrame)
                _window.requestAnimationFrame = function (callback, element) {
                    var currTime = new Date().getTime();
                    var timeToCall = Math.max(0, 16 - (currTime - lastTime));
                    var id = _window.setTimeout(function () {
                            callback(currTime + timeToCall);
                        },
                        timeToCall);
                    lastTime = currTime + timeToCall;
                    return id;
                };

            if (!_window.cancelAnimationFrame)
                _window.cancelAnimationFrame = function (id) {
                    clearTimeout(id);
                };
        }());

        $('img.cover').each(function(idx, elt){
            makeCover(elt, {});
        });
		$('img.cover-linked').each(function(idx, elt){
            makeCoverLinked(elt, {});
        });
        if ($('.catalog-filter').length) {
            filter.init();
        }
        if ($('.wishlist').length) {
            wishlist.init();
        }

        if ($('.news-list-cnt').length) {
            $('.news-list-cnt').find('img').unveil();
        }
        if ($('.item-cards-list-cnt').length) {
            if (app.mobile) {
                $('.item-cards-list-cnt').find('img').unveil(500, function(){
                    $(this).load(function() {
                        $(this).addClass('vis');
                    });
                });
            } else {
                $('.item-cards-list-cnt').find('img').unveil(0, function(){
                    $(this).load(function() {
                        $(this).addClass('vis');
                    });
                });
            }
        }
        if (app.mobile) {
            $('.mobile-menu-wrapper').css({'height': getViewport()[1] + 'px'});
        }
        cart.init();
        socialShare();
        return this;
    };

    app.initSplash = function(){
	if($('#splash').html()){
		var fancy = $.extend({}, fancyDefaultSettings, {padding:[0,0,0,0], content: $('#splash').html()});
		$.fancybox(fancy);
	}
    };

    app.initPlaceholders = function() {
        if (!hasPlaceholderSupport()) {
            $('[placeholder]').focus(function() {
                var input = $(this);
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                    input.removeClass('placeholder');
                }
            }).blur(function() {
                var input = $(this);
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.addClass('placeholder');
                    input.val(input.attr('placeholder'));
                }
                if (input.val() == input.attr('placeholder')) {
                    input.attr('data-parsley-value', '');
                } else {
                    input.removeAttr('data-parsley-value');
                }
            }).blur();
        }
        return this;
    };

    app.initValidation = function(){
        var formsToValidate = [
            'callback-form-cnt',
            'common-form',
            'subscribe-form-cnt'
        ];

        $.each(formsToValidate, function(idx, elt){
            var $form = $('.' + elt).find('form');
            if ($form.length) {
                $form.each(function(idx, elt){
                    $(elt).parsley({
                        classHandler: function (ParsleyField) {
                            return ParsleyField.$element.closest('fieldset');
                        },
                        excluded: 'input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled]'
                    }).subscribe('parsley:form:validate', function(formInstance) {
                        if (formInstance.isValid()) {
                            if (formInstance.$element.closest('.subscribe-form-cnt').length) {

                                formInstance.submitEvent.preventDefault();
                                var $input = formInstance.$element.find('input[type=email]');
                                $.ajax({
                                    url: '/ajax/subscribe.php/',
                                    data: formInstance.$element.serialize(),
                                    type: 'POST',
                                    dataType: 'json',
                                    success: function(result){
                                        if (result.result) {
                                            subscribeResult = 'Успешно'
                                            ga('send', 'event', 'newsletter', 'sign-up');
                                        } else {
                                            subscribeResult = 'Ошибка'
                                        }
                                        if (result.value) {
                                            var settings = $.extend({}, fancyDefaultSettings, {
                                                content:'<p class="popup-header">' + subscribeResult + '</p><div class="text-content"><p>' + result.value + '</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                                            });
                                            $.fancybox(settings);
                                            if (!hasPlaceholderSupport()) {

                                                $input.val($input.attr('placeholder'));
                                            } else {
                                                $input.val('');
                                            }
                                        }
                                    }
                                })
                            }
                        }
                    });
                });
            }
        });

        return this;
    };

    app.initFallbacks = function(){
        return this;
    };

    app.initPopups = function(){
        var imageFancySettings = $.extend({}, fancyDefaultSettings, {padding: 0});

        $('.fancy-popup').fancybox(fancyDefaultSettings);

        $('.js-fbx-image').fancybox(imageFancySettings);

        if (!app.mobile) {
            
            if ($('.js-zoom').length){

                var fbxNum = 0;

                $('.js-zoom img').imagezoomsl({
                    zoomrange: [3, 3],
                    magnifiersize: ['430px', '560px'],
                    cursorshade: false
                });

                $(document).on("click",".item-card-photos-pager a",function(){ 
                    fbxNum = $(this).attr('data-slide-index');
                });

                $(document).on("click",".tracker",function(){ 
                    $(".js-fbx-image").eq(fbxNum).trigger("click");
                });

            }

        }
        
        $('#project-slider').on('click', '.cs-project-slider', function(e){
            e.preventDefault();
            var $me = $(this),
                $links = $me.siblings('.js-fbx-image'),
                url = $me.attr('href'),
                curIndex = 0,
                jumped = false,

                imagesArr = $.map($links, function(elt, idx){
                    var href = $(elt).attr('href');
                    if (href == url) { curIndex = idx; }
                    return href;
                });

            var projectImageFancySettings = $.extend({}, fancyDefaultSettings, {padding: 0, afterShow: function(){
                if (!jumped) {
                    $.fancybox.jumpto(curIndex);
                    jumped = true;
                }
            }});
            console.log(imagesArr);
            $.fancybox(imagesArr, projectImageFancySettings);
            //$.fancybox.jumpto(curIndex);
        });

        $('.js-show-on-map').fancybox({
            padding: 0,
            wrapCSS: 'arteva-popup',
            tpl: {
                closeBtn: '<div class="fancybox__close"><a class="fbx__close" href="#">&nbsp;</a></div>'
            },
            minWidth: 380,
            openEffect  : 'drop',
            closeEffect : 'drop',
            nextEffect  : 'elastic',
            prevEffect  : 'elastic',
            afterShow: function() {
                if (!map) {
                    var lat = parseFloat($('#map').attr('data-lat')),
                        long = parseFloat($('#map').attr('data-long')),
                        markerIcon = '/img/icon_pin.png',
                        bounds;

                    var initialZoom = 16;
                    var style = [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-77}]},{"featureType":"road"}];
                    var mapOptions = {
                        center: new google.maps.LatLng(lat, long),
                        zoom: initialZoom,
                        disableDefaultUI: true,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles:style,
                        scrollwheel:false,
                        zoomControl: true
                    };

                    map = new google.maps.Map($('#map')[0],mapOptions);
                    var latLng = new google.maps.LatLng(lat, long);
                    var marker = new google.maps.Marker({
                        position: latLng,
                        icon: markerIcon
                    });
                    bounds = new google.maps.LatLngBounds();

                    marker.setMap(map);
                    bounds.extend(latLng);

                }
            }
        });

        if ($('.video-link').length) {
            $('.video-link').fancybox({
                tpl: {
                    closeBtn: '<div class="fancybox__close"><a class="fbx__close" href="#">&nbsp;</a></div>'
                }
            });
        }

        if ($('.error-auth-form').length) {
            $('a[href="#auth-form"]').trigger('click');
        }

        if (typeof Storage !== "undefined"){
            if (app.isStorage()) {
                if (!storage.load('artevaSplash')) {
                    app.initSplash();
                    storage.save('artevaSplash', {'visited': true}, 1440);
                }
            } else {
                console.log('No LocalStorage support');
            }
        } else {
            console.log('No LocalStorage support');
        }

        return this;
    };

    app.isStorage = function(){
        var mod = 'modernizr';
        try {
            localStorage.setItem(mod, mod);
            localStorage.removeItem(mod);
            return true;
        } catch(e) {
            return false;
        }
    };

    app.initTooltips = function(){
        return this;
    };

    app.processCheckboxes = function(){
        var $label = $(this);
        var targetId = $label.attr('for');
        var $targetInput = $('#' + targetId);

        if ($targetInput.is(':checkbox')) {
            if ($targetInput.is('.checked')) {
                $targetInput.removeClass('checked');
                if ($('html').hasClass('lt-ie9')) {
                    $targetInput.removeAttr('checked');
                }
            } else {
                $targetInput.addClass('checked');
                if ($('html').hasClass('lt-ie9')) {
                    $targetInput.attr('checked', 'checked');
                }
            }
        }
        if ($targetInput.is(':radio')) {
            var name = $targetInput.attr('name');
            if (!$targetInput.is('.checked')) {
                $('input[name="' + name + '"]').removeClass('checked').removeAttr('checked');
                $targetInput.addClass('checked').attr('checked', 'checked');
            }
        }
    };

    app.initSliders = function(){
        if ($('.main-slider').length) {
            $('.main-slider').bxSlider({
                easing: 'ease',
				mode: 'fade',
				// pause: 1000,
				speed: 1500,
				autoHover : true,
                auto: true,
                nextText: '',
                prevText: '',
                buildPager: function(){return '';}
            });
        }

        if ($('.item-cross').length || $('.item-recent-viewed').length) {

            if (app.mobile){
                $('.js-item-cards-slider').bxSlider({
                    easing: 'ease',
                    infiniteLoop: false,
                    auto: false,
                    nextText: '',
                    prevText: '',
                    pager: false,
                    slideWidth: 570
                });
            }
            if (!app.mobile){
                var m = 0;
                if (app.vpWidth >=1900) {
                    m = 8;
                } else {
                    m = 20
                }
                $('.js-item-cards-slider').bxSlider({
                    infiniteLoop: false,
                    auto: false,
                    nextText: '',
                    prevText: '',
                    pager: false,
                    slideWidth: 220,
                    minSlides: 4,
                    maxSlides:4,
                    slideMargin: m,
                    hideControlOnEnd: true
                });
            }
        }

        if ($('.item-card-photos').length) {
            $('.item-card-photos').bxSlider({
                pagerCustom: '.item-card-photos-pager',
                mode: 'fade',
                controls: false
            });
        }

        if ($('#project-slider').length) {
            if (!app.mobile) {
                if ($('#project-slider').find('.project-image').length > 1) {
                    $('#project-slider').coinslider({
                        width: 540,
                        height: 320,
                        delay: 5000,
                        sDelay: 20,
                        links: true,
                        hoverPause: true
                    });
                }
            }
        }

        if ($('.salon-slider').length) {
            var salonSliderSettings = {
                pagerCustom: '.salon-slider-pager',
                mode: 'fade',
                auto: true,
                controls: false,
                onSlideAfter: function(){
                    BackgroundCheck.refresh();
                }
            };
            if ($('.salon-slider').find('.slide').length == 1) {
                salonSliderSettings.auto = false;
                salonSliderSettings.pagerCustom = '';
            }

            if (!$('.salon-slider-pager').length) {
                salonSliderSettings.pager = false
            }

            $('.salon-slider').bxSlider(salonSliderSettings);
        }

        if ($('.auth-slider').length) {
            authSlider = $('.auth-slider').bxSlider({
                infiniteLoop:false,
                pager: false,
                nextText: '',
                prevText: '',
                controls: false,
                touchEnabled: false,
                adaptiveHeight: true
            });

            if ($('.error-reg-form').length) {
                setTimeout(function(){
                    authSlider.goToNextSlide();
                }, 500);
            }

        }

        if ($('.salons-slider-cnt').length) {
            var numslides = $('.salons-slider-cnt').find('.swiper-slide').length;
            if (device.desktop()) {
                salonsSlider = $('.salons-slider-cnt').swiper({
                    loop: true,
                    slidesPerView: 'auto',
                    cssWidthAndHeight: true,
                    centeredSlides: true,
                    calculateHeight: true,
                    loopedSlides: numslides,
                    progress: true,
                    createPagination: false,
                    speed: 600,
                    onProgressChange: function(swiper) {
                        //Plugin adds "progress" property to each slide and common "progress" property for swiper
                        for (var i = 0; i < swiper.slides.length; i++) {
                            var slide = swiper.slides[i];
                            var progress = slide.progress;
                            //Do something depending on slideProgress
                            var opacity;
                            opacity = 1 - Math.min(Math.abs(3*progress/4),1);
                            slide.style.opacity = opacity;
                        }
                    },
                    onTouchStart:function(swiper){
                        for (var i = 0; i < swiper.slides.length; i++){
                            swiper.setTransition(swiper.slides[i], 0);
                        }
                    },
                    onSetWrapperTransition: function(swiper, speed) {
                        for (var i = 0; i < swiper.slides.length; i++){
                            swiper.setTransition(swiper.slides[i], speed);
                        }
                    }
                });
            } else {
                salonsSlider = $('.salons-slider-cnt').swiper({
                    loop: true,
                    slidesPerView: 1,
                    centeredSlides: true,
                    calculateHeight: true,
                    loopedSlides: numslides,
                    createPagination: false,
                    speed: 300
                });
            }

        }

        return this;
    };

    app.initCustomScrolls = function(){
        if ($('.js-scrollable').length){
            $('.js-scrollable').mCustomScrollbar();
        }
        return this;
    };

    app.initFormElements = function(){
//        $('.js-common-select').chosen({
//            disable_search: true,
//            inherit_select_classes: true,
//            width: '100%'
//        });

        return this;
    };

    app.initMask = function(){
        if ($('.js-masked').length) {
            $('.js-masked').mask('+7 999 999-99-99');
        }
    };

    app.initGlobalEvents = function(){

        var topHeight = $('.top-row').outerHeight(),
            $siteHeader = $('.site-header'),
            // + $contentWrapper = $('.outer-content-wrapper'),
			// XXX $contentWrapper = $siteHeader.siblings('.content-wrapper'),
			$contentWrapper = $('.content-wrapper'),
					
            orderConfirmPage = $('.order-confirm').length,
            $checkoutTotal = $('.checkout-total-cnt'),
            headerHeight = $siteHeader.height() + 10,
            is404 = $('.page404').length,
            $itemCardWrapper = $('.item-card-wrapper'),
            $scrollTop = $('<a href="#" class="scrolltop"></a>'),
            projectsCurPage = 1,
            fixHeaderHandler = function(){				
                if ($(document).scrollTop() > topHeight) {
                    if (!is404) {
                        $siteHeader.addClass('fixed');
						$contentWrapper.each(function() {
                            if (!$(this).parents('.site-header').length){
                                if (!$(this).parents('.top-search-cnt').length){
    								$(this).css("padding-top", headerHeight + 'px');
                                    return false;
                                }
							}
						});                        
                    }
                } else {
                    $siteHeader.removeClass('fixed');
					$contentWrapper.each(function() {
						if (!$(this).parents('.site-header').length){
							$(this).css({paddingTop: 0});
						}
					}); 
                }
                if (orderConfirmPage) {
                    if ($(document).scrollTop() > 305){
                        $checkoutTotal.addClass('fixed');
                    } else {
                        $checkoutTotal.removeClass('fixed');
                    }
                }
            };
			
        $('body').append($scrollTop);
        $(_window).on('resize', function(){
            app.vp = getViewport();
            app.vpHeight = app.vp[1];
			// http://troppus.itech-group.ru/tickets/40219
            if (app.vpHeight > 600) {
                if ($(_window).width() > 640 && !app.mobile && !$('html').hasClass('lt-ie9') && !$('.js-big-cart-wrapper').length && !$('.checkout-page').length){
                    $(_window).on('scroll.topNav', fixHeaderHandler);
                }
            } else {
                $(_window).off('scroll.topNav');
            }
        }).trigger('resize');

//        if ($(_window).width() > 640 && !app.mobile && !$('html').hasClass('lt-ie9') ){
//            $(_window).on('scroll.topNav', fixHeaderHandler);
//        }

        //if ($(_window).width() < 641 || app.mobile) {
            $(_window).on('scroll.up', function(){
                if ($(document).scrollTop() > 600){
                    $scrollTop.fadeIn(200);
                } else {
                    $scrollTop.fadeOut(200);
                }
            });
        //}

        $(document).on('click.label', 'input.css-checkbox+label', app.processCheckboxes);

        $('.js-cart-trigger, .js-search-trigger, .js-mobile-menu-trigger').on('click', function(e){
            overlayTarget = $(this).attr('data-overlay');
            if (app.mobile && overlayTarget == 'cart') {
                _window.location.href = _window.location.origin + "/personal/cart/";
                return false;
            }
            if (overlayTarget == 'search') {
                setTimeout(function(){
                    $('.search-form-cnt').find('input[type=text]').focus();
                }, 300);
            }

            if ($('.js-big-cart').length && overlayTarget == 'cart') {
                return false;
            }

            e.preventDefault();
            if ($('.' + overlayTarget +'-visible').length) {
                $('.' + overlayTarget + '-visible').removeClass(overlayTarget + '-visible');
                overlayTarget = '';
            } else {
                $('#root-wrapper').addClass(overlayTarget + '-visible');
            }
        });

        $('.js-close-search, .js-close-menu').on('click', function(e){
            e.preventDefault();
            $('.' + overlayTarget + '-visible').removeClass(overlayTarget + '-visible');
            $(document).off('touchmove.mobileMenu');
        });

        $(document).on('click.overlay, touchstart.overlay', '.overlay', function(e){
            if ($(this).is(':visible')) {
                if (overlayTarget.length) {
                    $('.' + overlayTarget + '-visible').removeClass(overlayTarget + '-visible');
                    //$('body').removeClass('lock');
                }
            }
        });

        $(document).on('click', '.js-fbx-close', function(e){
            e.preventDefault();
            $.fancybox.close();
        });

        $('.accordeon-trigger').on('click', function(e){
            e.preventDefault();
            var $parent = $(this).closest('.accordeon-item');
            if ($parent.hasClass('collapsed')) {
                $('.accordeon-item').removeClass('expanded').addClass('collapsed');
                $parent.removeClass('collapsed').addClass('expanded');
            } else {
                $parent.removeClass('expanded').addClass('collapsed');
            }
        });
        $('.js-auth-switch').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                target = $me.attr('data-rel');
            if (target === 'auth-first-time') {
                authSlider.goToNextSlide();
            } else {
                authSlider.goToPrevSlide();
            }
            $('')
        });

        $('.js-payment-comment-trigger').on('click', function(e){
            e.preventDefault();
            $(this).next('fieldset').slideToggle(200);
        });

        $('.js-checkout-confirm-comment-trigger').on('click', function(e){
            e.preventDefault();
            $('.checkout-confirm-comment-cnt').slideToggle(200);
        });

        $('.js-order-contents-trigger').on('click', function(e){
            e.preventDefault();
            var $list = $(this).siblings('.lk-order-contents-wrapper');
            $list.slideToggle(200);
        });

        $('.js-lk-side-trigger').on('click', function(e){e.preventDefault();});
        $('.js-lk-side-trigger').on('touchstart', function(){
            $(this).siblings('aside').slideToggle(200);
        });

        $itemCardWrapper.on('click.increment', '.js-inc', function(e){
            e.preventDefault();
            var $me = $(this),
                $input = $me.siblings('.js-item-count'),
                curVal = parseInt($input.val());
            $input.val(curVal + 1);
        });

        $itemCardWrapper.on('click.decrement', '.js-dec', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('li'),
                $input = $me.siblings('.js-item-count'),
                curVal = parseInt($input.val());
            if (curVal > 1) {
                $input.val(curVal - 1);
            } else {
                return false;
            }

        });

        $('.js-add-to-fav').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                $card = $me.closest('.item-card-inner'),
                userId = $card.attr('data-user'),
                id = $card.attr('data-id'),
                count = parseInt($('.js-favotites-count').html());
            $me.addClass('busy');
            if ($me.attr('href')) {
                $.ajax({
                    url: '/ajax/favorites.php',
                    data: {
                        id: id,
                        user: userId
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data){
                        if (data.result) {
                            $me.removeClass('busy').removeAttr('href').text('В избранном').removeAttr('onclick');
                            $('.js-favotites-count').html(count + 1);
                        } else {
                            $me.removeClass('busy');
                            alert('Произошла ошибка. Попробуйте позже');
                        }
                    }
                })
            }
        });

        $('.js-print-version').on('click', function(e){
            e.preventDefault();
            _window.print();
        });

        $('.js-add-to-spec-popup').on('click', function(e){
            e.preventDefault();
            var $me = $(this);

            app.userId = $('.item-card-inner').attr('data-user') || $('.js-content-favorites').attr('data-user');
            app.itemId = $('.item-card-inner').attr('data-id') || $me.closest('.js-item').attr('data-id');
            app.itemCount = $me.closest('.js-item').find('.js-item-count').val();

            $me.addClass('busy');
            $.ajax({
                url: '/ajax/spec.php',
                data: {
                    action: 'get',
                    user: app.userId,
                    product: app.itemId
                },
                type: 'POST',
                dataType: 'html',
                success: function(response){
                    var settings = $.extend({}, fancyDefaultSettings, {
                        content:response,
                        afterShow: function(){
                            var $select = $.fancybox.inner.find('.js-common-select-nosearch');
                            if ($select.length) {
                                $select.chosen({
                                    disable_search: true,
                                    inherit_select_classes: true
                                });
                            }
                        }
                    });
                    $me.removeClass('busy');
                    $.fancybox(settings);
                }
            });
        });

        $(document).on('click', '#add-to-spec-form label', function(){
            var $me = $(this),
                val = $me.siblings('input').val();
            if (val === 'exist') {
                $('#new-spec-name').attr('disabled', 'disabled');
                $('#exist-spec-select').removeAttr('disabled');
                $('#exist-spec-select').trigger('chosen:updated');
            }
            if (val === 'new') {
                $('#new-spec-name').removeAttr('disabled');
                $('#exist-spec-select').attr('disabled', 'disabled');
                $('#exist-spec-select').trigger('chosen:updated');
            }
        });

        $(document).on('click', '.js-submit-spec', function(e){
            var specName = $('#new-spec-name').prop('disabled') ? undefined : $('#new-spec-name').val(),
                specId = $('#exist-spec-select').val(),
                itemCount = app.itemCount || $('.lk-page').find('.js-item-count').val() || $('.item-card-inner').find('.js-item-count').val(),
                $me = $(this),
                $form = $me.closest('form'),
                saveMessage = 'Товар добавлен в спецификацию';
            if (!app.userId) app.userId = $('.lk-page').attr('data-user');

            var data = {
                user: app.userId,
                product: app.itemId,
                spec: '',
                action: '',
                count: itemCount
            };


            if (specName !== undefined) {
                data.spec = specName;
                data.action = 'add';
            } else {
                data.spec = specId;
                data.action = 'update';
            }



            e.preventDefault();
            $form.addClass('loading');
            console.log(data);
            $.ajax({
                url: '/ajax/spec.php',
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    if (response.result) {
                        $form.removeClass('loading');
                        if (data.action == 'add') {
                            saveMessage = 'Спецификация успешно создана';
                        }
                        var settings = $.extend({}, fancyDefaultSettings, {
                            content:'<p class="popup-header">Успешно</p><div class="text-content"><p>' + saveMessage + '</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                        });
                        if ($('.lk-page').length) {
                            $.extend(settings, {
                                afterClose: function(){
                                    _window.location.reload();
                                }
                            })
                        }
                        $.fancybox(settings);
                    } else {
                        $form.removeClass('loading');
                        alert('Произошла ошибка. Попробуйте позже');
                    }
                }
            });

        });

        $('.js-lk-spec-remove').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                $spec = $me.closest('.js-lk-spec'),
                specId = $spec.attr('data-spec'),
                userId = $('.lk-page').attr('data-user');

            if (confirm('Действительно удалить спецификацию?')) {
                $me.addClass('busy');
                $.ajax({
                    url:'/ajax/spec.php',
                    data: {
                        spec: specId,
                        action: 'remove'
                    },
                    type: "POST",
                    dataType:'json',
                    success: function(response){
                        var settings;
                        if (response.result) {
                            settings = $.extend({}, fancyDefaultSettings, {
                                content:'<p class="popup-header">Успешно</p><div class="text-content"><p>Спецификация была удалена</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                            });
                            $spec.fadeOut(200);
                        } else {
                            settings = $.extend({}, fancyDefaultSettings, {
                                content:'<p class="popup-header">Ошибка</p><div class="text-content"><p>Во время удаления произошла ошибка. <br/> Пожалуйста, попробуйте позже</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                            });
                        }
                        $.fancybox(settings);
                    }
                })
            }

        });

        $('.js-lk-spec-item-remove').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-lk-spec-item'),
                $list = $me.closest('.checkout-order-list'),
                $specCnt = $list.closest('.lk-order-contents-wrapper'),
                productId = $item.attr('data-id');
            if (confirm('Действительно удалить элемент из спецификации?')) {
                $.ajax({
                    url:'/ajax/spec.php',
                    data: {
                        product: productId,
                        action: 'remove'
                    },
                    type: "POST",
                    dataType:'json',
                    success: function(response){
                        var settings;
                        if (response.result) {
                            settings = $.extend({}, fancyDefaultSettings, {
                                content:'<p class="popup-header">Успешно</p><div class="text-content"><p>Элемент был удален из спецификации</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>',
                                afterClose: function(){
                                    _window.location.reload();
                                }
                            });
                            $item.fadeOut(200);
                        } else {
                            settings = $.extend({}, fancyDefaultSettings, {
                                content:'<p class="popup-header">Ошибка</p><div class="text-content"><p>Во время удаления произошла ошибка. <br/> Пожалуйста, попробуйте позже</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                            });
                        }
                        $.fancybox(settings);
                    }
                })
            }
        });

        $('.swiper-controls .next').on('click', function(e){
            e.preventDefault();
            salonsSlider.swipeNext();
        });
        $('.swiper-controls .prev').on('click', function(e){
            e.preventDefault();
            salonsSlider.swipePrev();
        });

        $('.js-show-more-links').on('click', function(e){
            e.preventDefault();
            $(this).next('ul').toggleClass('visible');
        });

        $('input[name="DELIVERY_ID"]').on('click', function(){
            var $me = $(this);

            $me.closest('ul').find('.js-toggle').slideUp(200);
            $me.closest('ul').find('.js-toggle').find('textarea').attr('disabled','disabled');
            if ($me.attr('data-toggle') === '1') {
                $me.closest('li').next('.js-toggle').slideDown(200);
                $me.closest('li').next('.js-toggle').find('textarea').removeAttr('disabled');
            }
        });
        $('input[name="tk-name"]').on('click', function(){
            var $me = $(this),
                rel = $me.attr('rel');
            if ( rel && rel !== '') {
                $(rel).removeAttr('disabled');
            } else {
                $('#tk-custom-name').attr('disabled', 'disabled');
            }
        });

        $('input[name="PAY_SYSTEM_ID"]').on('click', function(){
            var $me = $(this),
                rel = $me.attr('rel');
            if (rel && rel == 'requisits' ) {
                $me.closest('fieldset').next('fieldset').slideDown(200);
                $('#requisits').removeAttr('disabled');
                $('#warning').closest('fieldset').slideUp(200);
            } else {
                if (rel && rel == 'warning') {
                    $('#warning').closest('fieldset').slideDown(200);
                    $('#requisits').closest('fieldset').slideUp(200);
                    $('#requisits').attr('disabled', 'disabled');
                } else {
                    $('#requisits').closest('fieldset').slideUp(200);
                    $('#requisits').attr('disabled', 'disabled');
                }
            }
        });

        $('.js-project-remove').on('click', function(e){
            var $me = $(this),
                $project = $me.closest('.designer-project-item'),
                id = $me.attr('data-id');
            $me.addClass('busy');
            $.ajax({
                url: '/ajax/project.php',
                data: {
                    project: id
                },
                type: 'POST',
                dataType:'json',
                success: function(response){
                    /* alert(); */
                    if (response.result) {
                        $project.fadeOut(200).remove();
                    } else {
                        var settings = $.extend({}, fancyDefaultSettings, {
                            content:'<p class="popup-header">Ошибка</p><div class="text-content"><p>Во время выполнения произошла ошибка. Попробуйте позже.</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                        });
                        $.fancybox(settings);
                        $me.removeClass('busy');
                    }
                },
                error: function(){
                    var settings = $.extend({}, fancyDefaultSettings, {
                        content:'<p class="popup-header">Ошибка</p><div class="text-content"><p>Во время выполнения произошла ошибка. Попробуйте позже.</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                    });
                    $.fancybox(settings);
                    $me.removeClass('busy');
                }
            })
        });

        $('body').on('click', '.scrolltop', function(e){
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, '500', 'swing');
        });

        $('.js-subscribe-trigger').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                email = $me.attr('data-email'),
                action = $me.attr('data-action');
            $me.addClass('busy');
            $.ajax({
                url: '/ajax/subscribe.php/',
                data: {
                    email: email,
                    action: action
                },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    if (response.result) {
                        subscribeResult = 'Успешно'
                        window.location.reload();
                    } else {
                        subscribeResult = 'Ошибка'
                        if (response.value) {
                            var settings = $.extend({}, fancyDefaultSettings, {
                                content:'<p class="popup-header">' + subscribeResult + '</p><div class="text-content"><p>' + response.value + '</p></div><div class="acenter"><a class="btn js-fbx-close" href="#">Закрыть</a></div>'
                            });
                            $.fancybox(settings);
                            $me.removeClass('busy');
                        }
                    }
                }
            })

        });

        $('.has-sublist').on('mouseenter touchend', function(){
            var $me = $(this),
                $sublist = $me.find('.top-nav-sublist-cnt'),
                $submenuCnt = $sublist.find('.top-nav-submenu-cnt'),
                $imgWrapper = $sublist.find('.top-nav-img-wrapper'),
                submenusWidth = $submenuCnt.outerWidth(),
                imgWrapperWidth = menuWidth - submenusWidth - 20;
            $imgWrapper.width(imgWrapperWidth - 20);

            $sublist.addClass('active');
        });

        $('.has-sublist').on('mouseleave', function(){
            var $me = $(this),
                $sublist = $me.find('.top-nav-sublist-cnt');
            $sublist.removeClass('active');
        });

        $('.js-show-more-projects').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                pagesTotal = parseInt($('.designer-projects-list').attr('data-all-page'));
            $me.addClass('busy');
            projectsCurPage = projectsCurPage + 1;
            $.ajax({
                url: '/ajax/projects_page.php',
                data: {
                    PAGEN_1: projectsCurPage
                },
                type:'GET',
                dataType: 'html',
                success: function(response){
                    if (response.length) {
                        $('.designer-projects-list').append(response);
                        console.log('cur: ' + projectsCurPage + ', total: ' + pagesTotal);
                        if (projectsCurPage == pagesTotal) {
                            $('.show-more-projects-cnt').fadeOut(200).remove();
                        }
                    }
                    $me.removeClass('busy');
                }
            })
        });

        cart.initEvents();
        return this;
    };

    app.initUI = function(){

        var mapIsInteractive = false;
        if ($('.accordeon-cnt').length) {
            $('.accordeon-inner').each(function(idx, elt){
                $(this).css({height: $(this).find('.accordeon-content').outerHeight(true)});
                $('.accordeon-item').addClass('collapsed');
            });
        }

        if ($('.js-panes-control').length) {
            $('.js-pane-trigger').click(function(e){
                e.preventDefault();
                var $clickedTrigger = $(this); /* Находим кликнутый таб */
                var $panesControl = $clickedTrigger.parents('.js-panes-control'); /* Находим нужный контейнер */
                var $tabsItems = $panesControl.find('.js-tab-item');
                var $panesTriggers = $panesControl.find('.js-pane-trigger'); /* Находим табы в нужном контейнере */
                var $panesContainer = $('#' + $panesControl.attr('data-panes')); /* Находим связанные контейнеры с контентом */
                var $activePane = $panesContainer.children('.js-pane.active').eq(0); /* Находим активный контейнер */
                var paneId = $clickedTrigger.attr('href');
                var $paneToShow = $(paneId); /* Находим контейнер, который нужно показать */
                if (!$clickedTrigger.hasClass('active')) { /* Если кликнут неактивный таб, то */
                    $panesTriggers.removeClass('active'); /* убираем активные классы */
                    $tabsItems.removeClass('active');
                    $clickedTrigger.addClass('active');
                    $clickedTrigger.parents('.js-tab-item').addClass('active');
                    $activePane.stop().fadeOut(100, function(){
                        $paneToShow.stop().fadeIn(100, function(){
                            // $(document).trigger('pane.switch', [paneId]); /* Опционально генерация события переключения */
                            $paneToShow.addClass('active');
                        });
                        $activePane.removeClass('active');
                    });

                }
            });
        }
        if ($('.salon-page').length) {
            BackgroundCheck.init({
                targets: '.bc-item, h1',
                images: 'img.bgc-image'
            });
        }

        if ($('.js-common-select').length) {
            $('.js-common-select').chosen({
                inherit_select_classes: true
            });
        }
        if ($('.js-common-select-nosearch').length) {
            $('.js-common-select-nosearch').chosen({
                disable_search: true,
                inherit_select_classes: true
            });
        }

        $('.js-search-page').on('change', function(){
            _window.location.search = $(this).val();
        });

        if ($('#contacts-map').length) {
            var lat = parseFloat($('#contacts-map').attr('data-lat')),
                long = parseFloat($('#contacts-map').attr('data-long')),
                markerIcon = '/img/icon_pin.png',
                bounds, latLng, marker;

            var initialZoom = 16;
            var style = [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-77}]},{"featureType":"road"}];
            var mapOptions = {
                center: new google.maps.LatLng(lat, long),
                zoom: initialZoom,
                disableDefaultUI: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles:style,
                scrollwheel:false,
                zoomControl: true,
                draggable: false
            };

            map = new google.maps.Map($('#contacts-map')[0],mapOptions);

            google.maps.event.addListener(map, 'click', function() {
                if (!mapIsInteractive) {
                    map.setOptions({scrollwheel:true, draggable: true});
                    mapIsInteractive = true;
                } else {
                    map.setOptions({scrollwheel:false, draggable: false});
                    mapIsInteractive = false;
                }

            });

            latLng = new google.maps.LatLng(lat, long);
            marker = new google.maps.Marker({
                position: latLng,
                icon: markerIcon
            });
            bounds = new google.maps.LatLngBounds();

            marker.setMap(map);
            bounds.extend(latLng);
        }

        if ($('.page404').length && app.mobile) {
            $('#root-wrapper').css({'min-height': 'inherit'});
        }

        if (device.tablet() && !app.mobile) {
            $( '.top-nav-list li:has(ul)' ).doubleTapToGo();
        }

        $('.payment-links-section, .payment-section').on('click', 'a', function(e){
            var href = $(this).attr('href'),
                scroll;
            if (href[0] == '#' && href[1] !== '') {
                e.preventDefault();
                scroll = parseInt($(href).offset().top) - 160;
                $('html, body').animate({
                    scrollTop: scroll
                }, 1000);
            }
            if (href[0] == '#' && href[1] == undefined) {
                return false;
            }
            if (href[0] != '#') {
                return true;
                //_window.location = href;
            }
        });

        $('.js-print-spec').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                specHTML = $me.closest('.js-lk-spec').html();
            $('.js-print-cnt').empty().append(specHTML);
            _window.print();
        });

        $('.js-save-spec').on('click.saveSpec', function(e){
            e.preventDefault();
            var $me = $(this),
                $parent = $me.closest('.js-lk-spec'),
                specId = $parent.attr('data-spec');
            $me.addClass('busy');
            $.ajax({
                url:'/ajax/spec.php',
                data: {
                    action: 'file',
                    id: specId
                },
                type:'POST',
                dataType: 'json',
                success: function(response){
                    if (response.result) {
                        $me.attr('href', response.path).attr('download', response.path).attr('target','_blank').addClass('important').html('Скачать').off('click.saveSpec');
                        $me.removeClass('busy');
                    }
                }
            })
        });

        if ($('.delivery-list').length) {
            var $list = $('.delivery-list'),
                $radio = $list.find('.css-checkbox');
            $radio.each(function(idx, elt){
                if ($(elt).is(':checked')) {
                    var $sib = $(elt).closest('.delivery-list-item').next('.js-toggle');
                    if ($sib.length) {
                        $sib.show();
                        $sib.find('textarea').removeAttr('disabled');
                    }
                }
            })

        }

        return this;
    };

    return app;
})(jQuery, window);

var filter = (function($, _window){
    var f = {},
        sort = {
            NO_SORT: -1,
            SORT_DESC: 0,
            SORT_ASC: 1
        },
        $slider = $('.price-slider'),
        $catalogCnt = $('.item-cards-list-cnt'),
        $catalogList = $('.item-cards-list'),
        resetFilter = {
            priceMin: 0,
            priceMax: 0,
            presence: false,
            sortPopular: sort.NO_SORT,
            sortPrice: sort.NO_SORT,
            section_code: $('[name="section_code"]').val(),
            section_id: $('[name="section_id"]').val(),
            'new': $('[name="new"]').val(),
            sale: $('[name="sale"]').val(),
            q: $('.catalog-filter').find('[name="q"]').val(), // для поиска
            onthepage: $('.catalog-filter').find('[name="onthepage"]').val(), // для поиска
            SHOWALL_1: 0
        },

        filter = {
            priceMin: 0,
            priceMax: 0,
            presence: false,
            sortPopular: sort.NO_SORT,
            sortPrice: sort.NO_SORT,
            section_code: $('[name="section_code"]').val(),
            section_id: $('[name="section_id"]').val(),
            'new': $('[name="new"]').val(),
            sale: $('[name="sale"]').val(),
            q: $('.catalog-filter').find('[name="q"]').val(), // для поиска
            onthepage: $('.catalog-filter').find('[name="onthepage"]').val(), // для поиска
            SHOWALL_1: 0,
			sale_bb:  $('[name="new_sale_bb"]').val()
        },
        $emptyResult =
            '<li class="item-card-item empty-list">' +
                '<div class="ib m"><h3>По вашему запросу не найдено ни одного товара</h3></div>' +
            '</li>',
        filterTimeout,
        sendFilterAJAX = function(filter){
            var url = '/ajax/filter.php';
            if ($('.js-page').length && $('.js-page').attr('data-page') == 'search') url = '/ajax/search_catalog.php'; // для поиска
            return $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: filter
            });
        };

    f.init = function(){
        f.initUI().initEvents();
        //f.doFilter();
    };

    f.initUI = function(){
        var $selects = $('.js-multiple-select');
        if ($slider.length) {
            var rangeMin = parseFloat($slider.attr('data-min')),
                rangeMax = parseFloat($slider.attr('data-max')),
                min = parseFloat($slider.attr('data-current-min')),
                max = parseFloat($slider.attr('data-current-max'));
            filter.priceMin = min;
            filter.priceMax = max;
            resetFilter.priceMin = min;
            resetFilter.priceMax = max;

            $slider.noUiSlider({
                start:[min, max],
                step: 100,
                connect: true,
                range: {
                    'min': rangeMin,
                    '50%': 100000, // 0.1 * (rangeMax - rangeMin)
                    '60%': 250000, //0.25 * (rangeMax - rangeMin)
                    '70%': 400000, // 0.4 * (rangeMax - rangeMin)
                    '80%': 600000, // 0.6 * (rangeMax - rangeMin)
                    '90%': 800000, // 0.8 * (rangeMax - rangeMin)
                    'max': rangeMax
                }
            });
            $slider.Link('lower').to($('#price-min'));
            $slider.Link('upper').to($('#price-max'));
            $slider.Link('lower').to($('.price-min'), null, wNumb({
                decimals:0,
                thousand: ' '
            }));
            $slider.Link('upper').to($('.price-max'), null, wNumb({
                decimals:0,
                thousand: ' '
            }));

        }

        $selects.chosen({
            inherit_select_classes: true
        });

        $('.catalog-filter-bottom').hide();

        $.each($selects, function(idx,elt){
            var groupName = $(elt).attr('data-name');
            filter[groupName] = [];
        });

        return this;
    };

    f.resetFilter = function(){
        var rangeMin = parseFloat($slider.attr('data-min')),
            rangeMax = parseFloat($slider.attr('data-max'));
        $('.js-sort').removeClass('sort-asc').removeClass('sort-desc').addClass('sort-none');
        $slider.val([rangeMin, rangeMax]);
        $('.js-filter-presence').removeAttr('checked').removeClass('checked');
        $('.js-multiple-select').find('option').each(function(idx, elt){
            $(elt).removeAttr('selected');
        });
        $('.js-multiple-select').trigger('chosen:updated');

        f.doFilter(resetFilter, function(){
            $('.js-reset-filter').removeClass('show');
        });
    };

    f.initEvents = function(){
        var resetFields = function(){
            $('.js-sort').removeClass('sort-asc').removeClass('sort-desc').attr('data-state', 'none').addClass('sort-none');
            filter.sortPopular = sort.NO_SORT;
            filter.sortPrice = sort.NO_SORT;
        };

        var filterIsOpen = BX.localStorage.get("filterIsOpen");
        if (filterIsOpen == null)
            filterIsOpen = true;

        // refresh value in storage
        BX.localStorage.set("filterIsOpen",filterIsOpen,36000);

        if (filterIsOpen)
        {
            $('.catalog-filter-bottom').slideDown(200);
            $('.js-filter-more-params').addClass('extended');
        }

        $('.js-filter-more-params').on('click', function(e){
            e.preventDefault();
            $('.catalog-filter-bottom').slideToggle(200);
            $(this).toggleClass('extended');
            BX.localStorage.set("filterIsOpen",$(this).hasClass('extended'),36000);
        });

        $('.js-sort').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                curState = $me.attr('data-state'),
                field = $me.attr('data-field');

            if (curState === 'none') {
                resetFields();
                $me.attr('data-state', 'asc').removeClass('sort-none').addClass('sort-asc');
                filter[field] = sort.SORT_ASC;
            }
            if (curState === 'asc') {
                resetFields();
                $me.attr('data-state', 'desc').removeClass('sort-asc').addClass('sort-desc');
                filter[field] = sort.SORT_DESC;
            }
            if (curState === 'desc') {
                resetFields();
                $me.attr('data-state', 'asc').removeClass('sort-desc').addClass('sort-asc');
                filter[field] = sort.SORT_ASC;
            }
            f.doFilter(filter);
        });

        $slider.on('set', function(){
            filter.priceMin = parseFloat($slider.val()[0]);
            filter.priceMax = parseFloat($slider.val()[1]);
            f.doFilter(filter);
        });

        $('.js-filter-presence').on('change', function(e){
            e.preventDefault();
            filter.presence = this.checked;
            f.doFilter(filter);
        });
        $('.js-multiple-select').on('change', function(){
            var groupName = $(this).attr('data-name');
            filter[groupName] = $(this).val();
            f.doFilter(filter);
        });

        $('.js-show-all-items').on('click', function(e){
            e.preventDefault();
            var $me = $(this);
            filter.SHOWALL_1 = 1;
            f.doFilter(filter, function(){
                $me.remove();
            });
        });

        $('.js-reset-filter').on('click', function(e){
            e.preventDefault();
            f.resetFilter();
        });
        return this;
    };

    f.doFilter = function(filter, callback){
        clearTimeout(filterTimeout);
        $('.js-reset-filter').addClass('show');
        filterTimeout = setTimeout(function(){
            $catalogCnt.addClass('loading');
            sendFilterAJAX(filter).done(function(result){
                if (result.html.length) {
                    var $result = $.map($(result.html), function(elt, idx){
                        if (elt.nodeName != "#text"){
                            return elt;
                        }
                    });
                    setTimeout(function(){
                        $catalogList.empty().append($result);
                        $catalogCnt.removeClass('loading');
                        $catalogList.find('img').unveil(0, function(){
                            $(this).load(function() {
                                $(this).addClass('vis');
                            });
                        });
                        if (result.showall) {
                            //$('.js-show-all-items').show();
                            $('.js-show-all-items').hide();
                            $('.js-show-all-items-2').show();
                        } else {
                            $('.js-show-all-items').hide();
                            $('.js-show-all-items-2').hide();
                        }

                        if (callback && typeof(callback) === "function") {
                            callback();
                        }
                    }, 300);

                } else {
                    setTimeout(function(){
                        $catalogList.empty().append($emptyResult);
                        $catalogCnt.removeClass('loading');
                        $('.js-show-all-items').hide();
                        $('.js-show-all-items-2').hide();
                        if (callback && typeof(callback) === "function") {
                            callback();
                        }
                    }, 300);
                }
                if (result.page.length && filter.SHOWALL_1 == 0) {
                    $('.js-pagination-cnt').replaceWith($(result.page));
                } else {
                    $('.js-pagination-cnt').html('');
                }
            });
        }, 1000);
    };

    f.getFilter = function(){
        return filter;
    };

    return f;
})(jQuery, window);

var cart = (function($, _window){
    var cart = {},
        $cartList,
        $bigCartWrapper = $('.js-big-cart-wrapper'),
        $bigCart = $('.js-big-cart'),

        cartHeight,
        $cartListCnt,

        maxHeight = application.vpHeight - 30 - $('.top-cart .header').outerHeight(true) - $('.cart-item-total-cnt').outerHeight(true) - $('.top-cart .submit-cnt').height() - 50,
        $cartWrapper = $('.top-cart'),

        $topCartInnerTotalSum = $cartWrapper.find('.js-total-sum'), // Сумма внутри корзины
        $cartButtonSum = $('.js-sum'), // Сумма на кнопке корзины
        $cartButtonCount = $('.js-cart-items-count'), // Количество на кнопке корзины

        returnedBasket = '',

        spacify = function(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
        despacify = function(x){
            return x.toString().replace(' ', '');
        };

    cart.init = function(){
        $cartList = $('.top-cart').find('.js-items-list');
        $cartListCnt = $cartList.closest('.top-cart-items-list-cnt');
        cartHeight = $cartList.outerHeight();
        if (cartHeight > maxHeight) {
            $cartListCnt.css({maxHeight: maxHeight});
            $cartListCnt.mCustomScrollbar();
        }
        return this;
    };

    cart.checkSizes = function(){
        $cartList = $('.top-cart').find('.js-items-list');
        $cartListCnt = $cartList.closest('.top-cart-items-list-cnt');
        cartHeight = $cartList.outerHeight();
        if (cartHeight > maxHeight) {
            $cartListCnt.css({maxHeight: maxHeight});
            $cartListCnt.mCustomScrollbar();
            $cartListCnt.mCustomScrollbar('update');
        }
    };

    cart.recalculate = function(){
        console.log('Recalculate cart');
        var totalCount = 0,
            sum = 0,
            $items = $cartWrapper.find('.js-item');

        $topCartInnerTotalSum = $cartWrapper.find('.js-total-sum');

        if ($items.length) {
            $items.each(function(idx, elt){
                var curPrice = parseInt($(elt).attr('data-price')),
                    curCount = parseInt($(elt).find('.js-item-count').val()),
                    $itemSum = $(elt).find('.js-item-sum');
                totalCount = totalCount + curCount;
                sum = sum + (curPrice * curCount);
                $itemSum.html(spacify(curCount * curPrice)).attr('data-sum', curPrice * curCount);
            });
        }
        $topCartInnerTotalSum.html(spacify(sum) + ' ').attr('data-sum', sum);
        $cartButtonSum.html(spacify(sum) + '<span class="rub">a</span>').attr('data-sum', sum);
        $cartButtonCount.html(totalCount);
    };

    cart.removeItem = function($item){
        $item.addClass('remove');
        setTimeout(function(){
            $item.slideUp(300, function(){
                $item.remove();
                $cartWrapper.empty().html(returnedBasket);
                cart.recalculate();
                cart.checkSizes();
            });
        }, 300);
    };

    cart.initEvents = function(){
        var changeCountHandler = function(e) {
            e.preventDefault();
            var $me = $(e.target),
                $item = $me.closest('.js-item'),
                $input = $item.find('.js-item-count'),

                //itemPrice = parseInt($item.attr('data-price')),
                //prevTotal = parseInt($topCartInnerTotalSum.attr('data-sum')),
                //prevTotalCount = parseInt($topCount.html()),
                curVal = parseInt($input.val()),
                //$sum = $item.find('.js-item-sum'),

                newVal = 0,
                newSum = 0,
                newTotal = 0;

            switch (e.data) {
                case 'plus':
                    //newVal = curVal + 1;
                    //newSum = newVal * itemPrice;
                    //newTotal = prevTotal + itemPrice;
                    $input.val(curVal + 1);
                    //$sum.attr('data-sum', newSum).html(spacify(newSum));
                    //$topCount.html(prevTotalCount + 1);
                    break;
                case 'minus':
                    if (curVal > 1) {
                        newVal = curVal - 1;
                        //newSum = newVal * itemPrice;
                        //newTotal = prevTotal - itemPrice;
                        //console.log(newTotal);
                        $input.val(newVal);
                        //$sum.attr('data-sum', newSum).html(spacify(newSum));
                        //$topCount.html(prevTotalCount - 1);
                    } else {
                        $item.find('.js-remove-item').trigger('click');
                        //cart.removeItem($item);
                        //newTotal = prevTotal - itemPrice;
                        //$topCount.html(prevTotalCount - 1);
                    }
                    break;
            }
            console.log('newTotal: ' + newTotal);
            //alert(newTotal);
            //$topCartInnerTotalSum.attr('data-sum', newTotal).html(spacify(newTotal));
            cart.recalculate();
            //$('.js-sum').attr('data-sum', newTotal).html(spacify(newTotal));
        };

        $('.js-cart-trigger').on('click.cart', function(e){
            e.preventDefault();
            //$('body').addClass('lock');
        });
        $cartWrapper.on('click','.js-close-cart', function(e){
            e.preventDefault();
            $('.cart-visible').removeClass('cart-visible');
        });

        $cartWrapper.on('click.increment', '.js-inc', 'plus', changeCountHandler);
        $cartWrapper.on('click.decrement', '.js-dec', 'minus', changeCountHandler);
        $cartWrapper.on('click.remove', '.js-remove-item', function(e) {
            e.preventDefault();

            var $me = $(this),
                $item = $me.closest('li'),
                id = $item.attr('data-id');

            $item.addClass('busy');
            $.ajax({
                url: '/ajax/basket_small.php',
                type:'GET',
                dataType:'html',
                data: {
                    action: 'DEL2BASKET',
                    id: id
                },
                success: function(data){
                    console.log(data);
                    if (data !== 'false') {
                        returnedBasket = data;
                        cart.removeItem($item);
                    } else {
                        $item.removeClass('busy');
                    }
                }
            });
        });

        $bigCartWrapper.on('click.increment', '.js-inc', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                $input = $item.find('.js-item-count'),
                curVal = parseInt($input.val());
            $input.val(curVal + 1);
            $('.cart-submit-cnt').find('.js-submit-form').addClass('js-recalc-big-cart').html('Пересчитать');

        });
        $bigCartWrapper.on('click.decrement', '.js-dec', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                $input = $item.find('.js-item-count'),
                curVal = parseInt($input.val()),
                newVal = 0;

            if (curVal > 1) {
                newVal = curVal - 1;
                $input.val(newVal);
                $('.cart-submit-cnt').find('.js-submit-form').addClass('js-recalc-big-cart').html('Пересчитать');
            } else {
                $item.find('.js-item-remove').trigger('click');
            }
        });
        $bigCartWrapper.on('click.remove', '.js-item-remove', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.cart-row'),
                id = $item.attr('data-id');

            /* AJAX */

            $item.addClass('busy');
            $.ajax({
                url: '/ajax/basket.php',
                type:'GET',
                dataType:'html',
                data: {
                    action: 'DEL2BASKET',
                    id: id
                },
                success: function(response){
                    if (response !== 'false') {
                        $item.removeClass('busy').addClass('remove');
                        setTimeout(function(){
                            $bigCartWrapper.empty().html(response);
                            var sum = $('.js-cart-sum').html() || 0,
                                count = $('.js-total-count').attr('data-count') || 0;
                            $('.js-sum').html(sum + ' <span class="rub">a</span>');
                            $('.js-cart-items-count').html(count);
                        }, 300);
                    } else {
                        $item.removeClass('busy');
                    }
                }
            });
        });

        $('.js-content-favorites').on('click', '.js-inc', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                $input = $item.find('.js-item-count'),
                curVal = parseInt($input.val());
            $input.val(curVal + 1);
        });

        $('.js-content-favorites').on('click.decrement', '.js-dec', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                $input = $item.find('.js-item-count'),
                curVal = parseInt($input.val()),
                newVal = 0;

            if (curVal > 1) {
                newVal = curVal - 1;
                $input.val(newVal);
            }
        });

        $(document).on('keyup', '.js-item-count', function(e){
            var $me = $(this),
                $item = $me.closest('.js-item');

            if ($item.closest('.top-cart').length) {
                if ($me.val() != "" && $me.val() == 0) {
                    $item.find('.js-remove-item').trigger('click');
                }

                if ($me.val() != "" && $me.val() != 0) {
                    var itemPrice = parseInt($item.attr('data-price')),
                        itemCount = parseInt($me.val());
                    $item.find('.js-item-sum').attr('data-sum', itemCount * itemPrice).html(spacify(itemCount * itemPrice));
                    cart.recalculate();
                }
            }
            if ($item.closest('.js-big-cart-wrapper').length) {
                $('.cart-submit-cnt').find('.js-submit-form').addClass('js-recalc-big-cart').html('Пересчитать');
            }
            if ($me.val() == "") {
                return false;
            }
        });

        $(document).on('keydown', '.js-item-count', function(e){
            var code = e.keyCode;
            if ( code == 8 || code == 46 ||
                    // Allow: home, end, left, right
                (e.keyCode >= 33 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            else {
                // Ensure that it is a number and stop the keypress
                if (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105 )) {
                    e.preventDefault();
                }
            }
        });

        $(document).on('blur', '.js-item-count', function(){
            var $me = $(this);
            if ($me.val() == "") {
                $me.val("1");
            } else {
                var $item = $me.closest('li')
            }
        });

        $(document).on('click.recalcBigCart', '.js-recalc-big-cart', function(e){
            e.preventDefault();
            var $me = $(this),
                $items = $bigCart.find('.cart-body').find('.js-item'),
                itemsArray = [];
            $items.each(function(idx, elt){
                var id = $(elt).attr('data-id'),
                    count = $(elt).find('.js-item-count').val();
                itemsArray.push({id: id, count: count});
            });
            $bigCart.addClass('busy');
            $.ajax({
                url:'/ajax/basket.php',
                data: {
                    action: 'UPDATE2BASKET',
                    items: itemsArray
                },
                type:'GET',
                dataType: 'html',
                success: function(response){
                    if (response !== 'false') {
                        $bigCartWrapper.empty().html(response);
                        $bigCart = $('.js-big-cart');
                        $('.js-sum').html($('.js-cart-sum').html() + ' <span class="rub">a</span>');
                        $('.js-cart-items-count').html($('.js-total-count').attr('data-count'));
                    } else {
                        $bigCart.removeClass('busy');

                    }
                }
            });

            //$me.off('click.recalcBigCart').html('Оформить заказ');

        });

        // $('.js-add-to-cart').on('click', function(e){
        $(document).on('click','.js-add-to-cart', function(e){
			
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                id = $item.attr('data-id'),
                count = parseInt($item.find('.js-item-count').val());
			
			console.log(id + "qwe" + count)
            $item.addClass('busy');
            if ($bigCartWrapper.length) {
                $bigCart.addClass('busy');
                $.ajax({
                    url:'/ajax/basket.php',
                    data: {
                        action: 'ADD2BASKET',
                        QUANTITY: count,
                        id: id
                    },
                    type:'GET',
                    dataType: 'html',
                    success: function(response){
                        if (response.length) {
                            $bigCartWrapper.empty().html(response);
                            $bigCart = $('.js-big-cart');
                            $item.removeClass('busy');
                            $('.js-sum').html($('.js-cart-sum').html() + ' <span class="rub">a</span>');
                            $('.js-cart-items-count').html($('.js-total-count').attr('data-count'));
                        }
                    }
                })
            } else {
                $.ajax({
                    url:'/ajax/basket_small.php',
                    data: {
                        action: 'ADD2BASKET',
                        QUANTITY: count,
                        id: id
                    },
                    type:'GET',
                    dataType: 'html',
                    success: function(response){
                        if (response.length) {
                            $cartWrapper.empty().html(response);
                            $item.removeClass('busy');
                            $('.js-cart-trigger').addClass('added');
                            setTimeout(function(){
                                $('.js-cart-trigger').removeClass('added');
                            }, 2000);
                            cart.recalculate();
                            cart.checkSizes();
                            //$cartListCnt.mCustomScrollbar('update');
                        }
                    }
                })

            }
        });

        $('.js-add-to-cart-inner').on('click', function(e){
            e.preventDefault();
            if ($(this).hasClass('busy')) { return false; }

            var $me = $(this),
                $cnt = $me.closest('.item-card-inner'),
                id = $cnt.attr('data-id'),
                action = 'ADD2BASKET',
                quantity = $cnt.find('.js-item-count').val();
            $me.addClass('busy');
            $.ajax({
                url: '/ajax/basket_small.php',
                type: 'GET',
                dataType: 'html',
                data: {
                    action: action,
                    QUANTITY: quantity,
                    id: id
                },
                success: function(result) {
                    if (result.length) {
                        $cartWrapper.empty().html(result);
                        var totalSum = $cartWrapper.find('.js-total-sum').html(),
                            $counts = $cartWrapper.find('.js-item-count'),
                            totalCount = 0;
                        $counts.each(function(idx, elt){
                            totalCount += parseInt($(elt).val());
                        });
                        $('.js-sum').html(totalSum + ' <span class="rub">a</span>');
                        $('.js-cart-items-count').html(totalCount);
                        $me.removeClass('busy');
                        $('.js-cart-trigger').addClass('added');
                        setTimeout(function(){
                            $('.js-cart-trigger').removeClass('added');
                        }, 2000);
                        cart.checkSizes();
                    }
                }
            })
        });

        $cartWrapper.on('click', '.js-goto-cart', function(e){
            e.preventDefault();
            var $items = $cartWrapper.find('.js-item'),
                itemsArray = [];
            $items.each(function(idx, elt){
                var id = $(elt).attr('data-id'),
                    count = $(elt).find('.js-item-count').val();
                itemsArray.push({id: id, count: count});
            });

            $.ajax({
                url: '/ajax/basket_small.php',
                type: 'GET',
                dataType: 'html',
                data: {
                    action: 'UPDATE2BASKET',
                    items: itemsArray
                },
                success: function(result) {
                    if (result.length) {
                        location.href='/personal/cart/';
                    }
                }
            })
        })
    };

    return cart;
})(jQuery, window);

var wishlist = (function($, _window){
    var wishlist = {},
        $ovl = $('<div class="preload-overlay"><i></i></div>');

    wishlist.init = function(){
        wishlist.initEvents();
    };

    wishlist.initEvents = function(){
        $('.js-wishlist-item-remove').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('.js-item'),
                id = $item.attr('data-id'),
                userId = $item.attr('data-user'),
                count = parseInt($('.js-favotites-count').html());
            $item.addClass('busy');
            $.ajax({
                url: '/ajax/favorites.php',
                data: {
                    id: id,
                    user: userId,
                    action: 'remove'
                },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    if (response.result) {
                        $item.removeClass('busy').addClass('remove');
                        setTimeout(function(){
                            $item.remove();
                        }, 400);
                        if (count == 0) {
                            count = 1;
                        }
                        $('.js-favotites-count').html(count - 1);
                    } else {
                        alert('Произошла ошибка. Попробуйте позже');
                    }
                }
            });
        });

        $('.js-wishlist-add-item').on('click', function(e){
            e.preventDefault();
            var $me = $(this),
                $item = $me.closest('li'),
                id = $item.attr('data-id');
            $item.append($ovl).addClass('loading');
            $.ajax({
                url: '/ajax/basket_small.php',
                data: {
                    action: 'ADD2BASKET',
                    QUANTITY: 1,
                    id: id
                },
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    if (data.result) {
                        $item.removeClass('loading');
                    } else {
                        alert('Произошла ошибка. Попробуйте позже');
                    }
                }
            })
        });
    };

    return wishlist;
})(jQuery, window);

var storage = {
    save : function(key, jsonData, expirationMin){
        //if (!Modernizr.localstorage){return false;}
        var expirationMS = expirationMin * 60 * 1000;
        var record = {value: JSON.stringify(jsonData), timestamp: new Date().getTime() + expirationMS}
        localStorage.setItem(key, JSON.stringify(record));
        return jsonData;
    },
    load : function(key){
        //if (!Modernizr.localstorage){return false;}
        var record = JSON.parse(localStorage.getItem(key));
        if (!record){return false;}
        return (new Date().getTime() < record.timestamp && JSON.parse(record.value));
    }
};

$(function(){
    application.
        init().
        initValidation().
        initFallbacks().
        initPopups().
        initTooltips().
        initSliders().
        initCustomScrolls().
        initFormElements().
        initPlaceholders().
        initGlobalEvents().
        initUI().
        initMask();
    support.init();
    $(window).load(function(){
    });
});


