jQuery(document).ready(function ($) {

    // --- Swiper Initialization with Unique ID Support ---
    document.querySelectorAll('.swiper').forEach(function (swiperEl) {
        let options = swiperEl.dataset.swiper ? JSON.parse(swiperEl.dataset.swiper) : {};

        // If navigation elements are defined, make sure to select the right DOM nodes
        let finalOptions = {
            ...options,
            navigation: options.navigation ? {
                nextEl: options.navigation.nextEl,
                prevEl: options.navigation.prevEl,
            } : false,
            pagination: options.pagination ? {
                el: options.pagination.el,
                clickable: options.pagination.clickable || false,
                type: options.pagination.type || 'bullets',
            } : false,
        };

        new Swiper(swiperEl, finalOptions);
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.swiper-container').forEach(function (swiperEl) {
            const config = swiperEl.getAttribute('data-swiper');
            if (!config) return;

            let swiperOptions = JSON.parse(config);

            // Resolve pagination element
            if (swiperOptions.pagination && typeof swiperOptions.pagination.el === 'string') {
                swiperOptions.pagination.el = swiperEl.querySelector(swiperOptions.pagination.el);
            }

            // Resolve navigation elements
            if (swiperOptions.navigation) {
                if (swiperOptions.navigation.nextEl)
                    swiperOptions.navigation.nextEl = swiperEl.querySelector(swiperOptions.navigation.nextEl);
                if (swiperOptions.navigation.prevEl)
                    swiperOptions.navigation.prevEl = swiperEl.querySelector(swiperOptions.navigation.prevEl);
            }

            new Swiper(swiperEl, swiperOptions);
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.swiper-container').forEach(function (swiperEl) {
            const config = swiperEl.getAttribute('data-swiper');
            if (!config) return;

            let swiperOptions = JSON.parse(config);

            // Resolve pagination element
            if (swiperOptions.pagination && typeof swiperOptions.pagination.el === 'string') {
                swiperOptions.pagination.el = swiperEl.querySelector(swiperOptions.pagination.el);
            }

            // Resolve navigation elements
            if (swiperOptions.navigation) {
                if (swiperOptions.navigation.nextEl)
                    swiperOptions.navigation.nextEl = swiperEl.querySelector(swiperOptions.navigation.nextEl);
                if (swiperOptions.navigation.prevEl)
                    swiperOptions.navigation.prevEl = swiperEl.querySelector(swiperOptions.navigation.prevEl);
            }

            new Swiper(swiperEl, swiperOptions);
        });
    });
    
});
