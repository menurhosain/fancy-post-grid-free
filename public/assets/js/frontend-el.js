; (function ($) {
    "use strict";
   
    // Elementor hooks for frontend and editor
    $(window).on("elementor/frontend/init", () => {
        const moduleHandler = elementorModules.frontend.handlers.Base;

        // Swiper Slider
        const fpgSwiperSlider = moduleHandler.extend({
            bindEvents: function bindEvents() {
                this.run();
            },
            run: function run() {
                const $addon = this.$element;
                let id = $addon.find('.fpg-unique-slider').attr('id');
                const $element = $addon.find('#' + id);

                if (!$element.find('.swiper').length) return;

                // Elementor breakpoints
                const el_breakpoints = elementorFrontend.config.responsive.activeBreakpoints || '';
                const breakpoints = {};
                for (let key in el_breakpoints) {
                    if (!el_breakpoints.hasOwnProperty(key)) continue;
                    const bp = el_breakpoints[key];
                    breakpoints[key] = bp.direction === 'max' ? bp.value : null;
                }
                const xl = breakpoints['laptop'] || 1366;
                const lg = breakpoints['tablet_extra'] || 1200;
                const md = breakpoints['tablet'] || 1024;
                const sm = breakpoints['mobile_extra'] || 880;
                const xs = breakpoints['mobile'] || 767;
                const xxs = 0;

                // Get Elementor settings
                const s = this.getElementSettings();

                // Responsive controls
                const slColumnXL = s.sl_column || 3;
                const slColumnLG = s.sl_column_laptop || slColumnXL;
                const slColumnMD = s.sl_column_tablet_extra || slColumnLG;
                const slColumnSM = s.sl_column_tablet || slColumnMD;
                const slColumnXS = s.sl_column_mobile_extra || slColumnSM;
                const slColumnXXS = s.sl_column_mobile || slColumnXS;
                const slidesPerView = {
                    xl: slColumnXL,
                    lg: slColumnLG,
                    md: slColumnMD,
                    sm: slColumnSM,
                    xs: slColumnXS,
                    xxs: slColumnXXS,
                };

                const slColumnGapXL = s.sl_column_gap || 30;
                const slColumnGapLG = s.sl_column_gap_laptop || slColumnGapXL;
                const slColumnGapMD = s.sl_column_gap_tablet_extra || slColumnGapLG;
                const slColumnGapSM = s.sl_column_gap_tablet || slColumnGapMD;
                const slColumnGapXS = s.sl_column_gap_mobile_extra || slColumnGapSM;
                const slColumnGapXXS = s.sl_column_gap_mobile || slColumnGapXS;
                const spaceBetween = {
                    xl: slColumnGapXL,
                    lg: slColumnGapLG,
                    md: slColumnGapMD,
                    sm: slColumnGapSM,
                    xs: slColumnGapXS,
                    xxs: slColumnGapXXS,
                };

                const slVerticalXL = s.sl_vertical || 'horizontal';
                const slVerticalLG = s.sl_vertical_laptop || slVerticalXL;
                const slVerticalMD = s.sl_vertical_tablet_extra || slVerticalLG;
                const slVerticalSM = s.sl_vertical_tablet || slVerticalMD;
                const slVerticalXS = s.sl_vertical_mobile_extra || slVerticalSM;
                const slVerticalXXS = s.sl_vertical_mobile || slVerticalXS;
                const slVertical = {
                    xl: slVerticalXL,
                    lg: slVerticalLG,
                    md: slVerticalMD,
                    sm: slVerticalSM,
                    xs: slVerticalXS,
                    xxs: slVerticalXXS,
                };

                // All main options
                const effect = s.slider_effect || 'slide';

                // Autoplay
                const autoplay = s.slider_autoplay === 'true' ? {
                    delay: parseInt(s.slider_interval || 3000),
                    disableOnInteraction: false,
                    pauseOnMouseEnter: s.slider_stop_on_hover === 'true',
                } : false;
                
                // Autoplay Progress Circle
                const progressCircle = $element.find(".autoplay-progress svg")[0];
                const progressContent = $element.find(".autoplay-progress span")[0];
                const swiperEvents = {};
                if (s.slide_item_circle_progress === 'true' && autoplay && progressCircle && progressContent) {
                    swiperEvents.autoplayTimeLeft = function (swiper, time, progress) {
                        progressCircle.style.setProperty("--progress", 1 - progress);
                        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                    };
                }
                
                // Pagination
                const hasDots = s.slider_dots === 'true';
                const bulletType = s.slider_bullet_type || 'bullets';
                const dynamicBullets = s.slider_dynamic_bullets === 'true';
                const decimalFraction = s.slider_decimal_fraction === 'yes';
                const hideTotalFraction = s.slider_current_fraction === 'yes';
                let pagination = false;

                if (hasDots) {
                    const paginationEl = $element.find('.swiper-pagination')[0];
                    pagination = {
                        el: paginationEl,
                        clickable: true,
                        dynamicBullets: dynamicBullets,
                        type: bulletType,
                        formatFractionCurrent: (num) => decimalFraction ? ('0' + num).slice(-2) : num,
                        formatFractionTotal: (num) => hideTotalFraction ? '' : (decimalFraction ? ('0' + num).slice(-2) : num),
                    };
                }

                // Navigation
                const hasNav = s.slider_nav === 'true';
                let navigation = false;
                if (hasNav) {
                    navigation = {
                        nextEl: $element.find('.swiper-button-next')[0],
                        prevEl: $element.find('.swiper-button-prev')[0],
                    };
                }

                // Scrollbar
                const hasScrollbar = s.slider_scrollbar === 'true';
                let scrollbar = false;
                if (hasScrollbar) {
                    scrollbar = {
                        el: $element.find('.swiper-scrollbar')[0],
                        hide: false,
                        draggable: true,
                    };
                }

                // Swiper effect customization
                const creativeEffect = s.slider_creative_style || '';
                const coverflowStyle = s.slider_coverflow_style || '';
                const cardsRotate = parseFloat(s.slider_cards_rotation_value || 2);
                const cardsSpacing = parseFloat(s.slider_cards_rotation_spacing_value || 8);

                const effectOptions = {};
                if (effect === 'cards') {
                    effectOptions.cardsEffect = {
                        slideShadows: false,
                        rotate: cardsRotate,
                        perSlideOffset: cardsSpacing,
                    };
                }
                if (effect === 'coverflow') {
                    effectOptions.coverflowEffect = {
                        rotate: coverflowStyle === 'two' ? 80 : 50,
                        stretch: 0,
                        depth: 100,
                        slideShadows: true,
                    };
                }
                if (effect === 'creative') {
                    effectOptions.creativeEffect = {
                        prev: { shadow: true, translate: ['-120%', 0, -500] },
                        next: { shadow: true, translate: ['120%', 0, -500] },
                    };
                }

                // Initialize Swiper
                const swiperEl = $element.find('.swiper')[0];

                const swiper = new Swiper(swiperEl, {
                    direction: slVertical.xl,
                    speed: parseInt(s.slider_speed || 500),
                    loop: s.slider_loop === 'true',
                    freeMode: s.slider_free_mode === 'true',
                    autoHeight: s.slider_auto_height === 'true',
                    mousewheel: s.slider_mousewheel === 'true',
                    keyboard: s.slider_keyboard_control === 'true',
                    centeredSlides: s.slider_center_mode === 'true',
                    slidesPerView: slidesPerView.xl,
                    spaceBetween: spaceBetween.xl,
                    slidesPerGroup: parseInt(s.slides_to_scroll || 1),
                    grabCursor: s.slider_grab_cursor === 'true',
                    initialSlide: parseInt(s.slider_initial_slide || 0),
                    autoplay,
                    effect,
                    ...effectOptions,
                    navigation,
                    pagination,
                    scrollbar,
                    on: swiperEvents,
                    breakpoints: {
                        0: { slidesPerView: slidesPerView.xxs, spaceBetween: spaceBetween.xxs, direction: slVertical.xxs },
                        [xs]: { slidesPerView: slidesPerView.xs, spaceBetween: spaceBetween.xs, direction: slVertical.xs },
                        [sm]: { slidesPerView: slidesPerView.sm, spaceBetween: spaceBetween.sm, direction: slVertical.sm },
                        [md]: { slidesPerView: slidesPerView.md, spaceBetween: spaceBetween.md, direction: slVertical.md },
                        [lg]: { slidesPerView: slidesPerView.lg, spaceBetween: spaceBetween.lg, direction: slVertical.lg },
                        [xl]: { slidesPerView: slidesPerView.xl, spaceBetween: spaceBetween.xl, direction: slVertical.xl },
                    },
                });
            }
        });

        // Video Player
        const fpgVideoPlayer = moduleHandler.extend({
            bindEvents: function bindEvents() {
                this.run();

                const $element = this.$element;
                const uniqueID = $element.data('id');
                const triggerName = `fpgAjaxFired_id_${uniqueID}`;
                $(document).on(triggerName, () => {
                    this.run();
                });
            },
            run: function run() {
                const $element = this.$element;

                if (!$element.find('.fpg-player').length) return;
                
                const s = this.getElementSettings();

                const autoplay = ('yes' === s.video_autoplay) ? true : false;
                const loop = ('yes' === s.video_loop) ? true : false;
                const muted = ('yes' === s.video_muted) ? true : false;
                const autoHideCtrl = ('yes' === s.video_controls_hide) ? true : false;
                const clickToPlay = ('yes' === s.video_click_to_play) ? true : false;
                const controls = s.video_controls || [];

                $element.find('.fpg-player').each(function () {
                    const player = new Plyr(this, {
                        controls: controls,
                        clickToPlay: clickToPlay,
                        hideControls: autoHideCtrl,
                        loop: { active: loop },
                        autoplay: autoplay,
                        muted: muted,
                        youtube: {
                            noCookie: true,
                            rel: 0,
                            modestbranding: 1,
                            showinfo: 0,
                            iv_load_policy: 3,
                        },
                        vimeo: {
                            byline: false,
                            portrait: false,
                            title: false,
                            transparent: false
                        }
                    });
                    if (autoplay) {
                        player.on('ready', () => {
                            player.play()
                        });
                    }
                });
            }
        });

        ['fpg-post-slider.default', 'fpg-post-categories.default'].forEach(widget => {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, function ($scope) {
                elementorFrontend.elementsHandler.addHandler(fpgSwiperSlider, {
                    $element: $scope
                });
            });
        });
        
        ['fpg-post-grid.default', 'fpg-post-group.default', 'fpg-post-slider.default', 'fpg-post-filter.default'].forEach(widget => {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, function ($scope) {
                elementorFrontend.elementsHandler.addHandler(fpgVideoPlayer, {
                    $element: $scope
                });
            });
        });
    });

})(jQuery);