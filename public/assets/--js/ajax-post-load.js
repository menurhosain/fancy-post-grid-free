;(function ($) {
    "use strict";

    $(document).ready(function () {
        $('.fpg-post-parent').each(function () {
            const $wrapper = $(this).find('.fpg-ajax');
            const $btnWrapper = $(this).find('.fpg-loadmore-wrapper');
            const $btn = $btnWrapper.find('.fpg-loadmore-btn');
            const $loadEndTxt = $btnWrapper.find('.fpg-load-complete-text');

            const $filterButtons = $(this).find('.fpg-filter-wrapper button');

            if (!$wrapper.length) return;

            let loading = false;

            const settings = $wrapper.data('settings');
            const uniqueID = settings.el_settings.id;
            const postsPerPage = parseInt(settings.query_arg.post_per_click ?? 6);
            const query_offset = parseInt(settings.query_arg.offset ?? 0);
            let offset = query_offset + $wrapper.find('.fpg-card-style').length;
            let catSlug = '';

            // ---------- Category Filter ----------
            if ($filterButtons.length) {
                $filterButtons.on('click', function () {
                    const $this = $(this);
                    catSlug = $this.data('category');

                    $filterButtons.removeClass('active');
                    $this.addClass('active');

                    $wrapper.parent().addClass('fpg-loading');

                    $.ajax({
                        url: fpgAjaxPostLoad.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'fpg_ajax_category_filter',
                            nonce: fpgAjaxPostLoad.nonce,
                            settings: settings,
                            category_slug: catSlug,
                        },
                        success: function (response) {
                            if (response && response.trim()) {
                                $wrapper.html(response);
                                offset = $wrapper.find('.fpg-card-style').length;
                                $btn.show();
                                $loadEndTxt.hide();
                                $btn.removeClass('load-complete');
                            }
                            $(document).trigger('fpgAjaxFired_' + uniqueID);
                        },
                        complete: function () {
                            $wrapper.parent().removeClass('fpg-loading');
                        },
                    });
                });
            }

            // ---------- Load More ----------
            if ($btnWrapper.length) {
                $btn.on('click', function () {
                    if (loading || $btn.hasClass('load-complete')) return;
                    loading = true;

                    $btn.addClass('fpg-btn-loading');
                    $.ajax({
                        url: fpgAjaxPostLoad.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'fpg_ajax_post_load',
                            nonce: fpgAjaxPostLoad.nonce,
                            settings: settings,
                            posts_per_page: postsPerPage,
                            offset: offset,
                            category_slug: catSlug,
                        },
                        success: function (response) {
                            if (response && response.trim()) {
                                $wrapper.append(response);
                                offset = query_offset + $wrapper.find('.fpg-card-style').length;
                            } else {
                                $btn.addClass('load-complete');
                                $btn.removeClass('fpg-btn-loading');
                                $btn.hide();
                                $loadEndTxt.show();
                            }
                            $(document).trigger('fpgAjaxFired_' + uniqueID);
                        },
                        complete: function () {
                            loading = false;
                            $btn.removeClass('fpg-btn-loading');
                        }
                    });
                });
            }
        });
    });
})(jQuery);
