(function($) {
    'use strict';

    // Wait for Elementor to be ready
    $(window).on('elementor/frontend/init', function() {
        initializeProModal();
    });

    // Also initialize on document ready for editor
    $(document).ready(function() {
        // Small delay to ensure Elementor controls are loaded
        setTimeout(initializeProModal, 1000);
    });

    function initializeProModal() {
        // Check if modal already exists
        if ($('#fpg-pro-modal').length) {
            return;
        }

        // Inject the modal HTML into the body
        const proModalHTML = `
        <div id="fpg-pro-modal" class="fpg-modal">
            <div class="fpg-modal-overlay"></div>
            <div class="fpg-modal-content">
                <span class="fpg-modal-close">&times;</span>
                <div class="fpg-modal-header">
					<span class="fpg-modal-icon">
					<svg height="50" width="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18 8H20C20.5523 8 21 8.44772 21 9V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V9C3 8.44772 3.44772 8 4 8H6V7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7V8ZM16 8V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V8H16ZM11 14V16H13V14H11ZM7 14V16H9V14H7ZM15 14V16H17V14H15Z"></path></svg>
					</span>
                    <h3 class="fpg-modal-title">
                        Fancy Post Grid
                        <span class="badge-pro">PRO</span>
                    </h3>
                </div>
                <div class="fpg-modal-body">
                    <p>Use Fancy Post Grid Block widget and dozens more pro features to extend your toolbox and build sites faster and better.</p>
                    <p><strong>Unlock premium grid styles, advanced layouts, and exclusive design options!</strong></p>
                </div>
                <div class="fpg-modal-footer">
                    <a href="https://rstheme.com/product/fancy-post-grid/" 
                       class="fpg-pro-btn" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        <span>🚀</span> Get Pro Version
                    </a>
                </div>
            </div>
        </div>
        `;

        $('body').append(proModalHTML);

        // Setup event handlers
        setupModalEvents();
        
        // Setup pro option click handlers
        setupProOptionHandlers();
        
        console.log('FPG Pro Modal initialized successfully');
    }

    function setupModalEvents() {
        // Close modal when clicking close button or overlay
        $(document).on('click', '.fpg-modal-close, .fpg-modal-overlay', function(e) {
            e.preventDefault();
            closeModal();
        });

        // Close modal with Escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $('#fpg-pro-modal').is(':visible')) {
                closeModal();
            }
        });

        // Prevent modal content clicks from closing modal
        $(document).on('click', '.fpg-modal-content', function(e) {
            e.stopPropagation();
        });
    }

    function setupProOptionHandlers() {
        // Handle clicks on pro options (7th option onwards)
        $(document).on('click', '.fpg-pro-grid-style .elementor-choices-label:nth-child(n+7)', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Remove any active states from pro options
            $(this).removeClass('elementor-choices-label-active');
            
            // Show the modal
            showModal();
            
            console.log('Pro option clicked, showing modal');
        });

        // Prevent pro options from being selected
        $(document).on('change', '.fpg-pro-grid-style input[type="radio"]', function() {
            const $label = $(this).closest('.elementor-choices-label');
            const index = $label.index() + 1;
            
            if (index >= 7) {
                // This is a pro option, prevent selection
                $(this).prop('checked', false);
                $label.removeClass('elementor-choices-label-active');
                
                // Show modal
                showModal();
            }
        });
    }

    function showModal() {
        const $modal = $('#fpg-pro-modal');
        
        if ($modal.length) {
            $modal.removeClass('hide').addClass('show').fadeIn(300);
            
            // Prevent body scroll
            $('body').addClass('fpg-modal-open');
            
            // Focus management for accessibility
            $modal.find('.fpg-modal-close').focus();
        }
    }

    function closeModal() {
        const $modal = $('#fpg-pro-modal');
        
        if ($modal.length) {
            $modal.removeClass('show').addClass('hide');
            
            setTimeout(function() {
                $modal.fadeOut(200);
                $modal.removeClass('hide');
            }, 100);
            
            // Restore body scroll
            $('body').removeClass('fpg-modal-open');
        }
    }

    // Handle dynamic content loading in Elementor editor
    if (window.elementor) {
        elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
            // Re-initialize when widget panel opens
            setTimeout(setupProOptionHandlers, 500);
        });
    }

    // Re-initialize when new controls are added dynamically
    $(document).on('DOMNodeInserted', '.fpg-pro-grid-style', function() {
        setTimeout(setupProOptionHandlers, 100);
    });
    jQuery(document).ready(function($) {
        // Append PRO badge to specific control label
        $('.elementor-control-category_filter .elementor-control-title').append('<span class="fpg-pro-badge">PRO</span>');
    });

    // CSS for preventing body scroll when modal is open
    const modalBodyStyles = `
        <style>
        body.fpg-modal-open {
            overflow: hidden;
        }
        </style>
    `;
    
    $('head').append(modalBodyStyles);

})(jQuery);