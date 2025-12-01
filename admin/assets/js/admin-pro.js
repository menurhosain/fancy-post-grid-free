jQuery(document).ready(function ($) {

    // ==========================
    //    FREE vs PRO STYLE LOGIC
    // ==========================

    // PRO-only style values
    const proValues = [
        'style4','style5','style6','style7','style8','style9','style10','style11','style12'
    ];

    // Insert modal only once
    if (!document.getElementById('fpg-pro-modal')) {
        $('body').append(`
            <div id="fpg-pro-modal" class="fpg-modal">
                <div class="fpg-modal-overlay"></div>
                <div class="fpg-modal-content">
                    <span class="fpg-modal-close">&times;</span>
                    <div class="fpg-modal-header">
                        <span class="fpg-modal-icon">
                            <svg height="50" width="50" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 8H20C20.5523 8 21 8.44772 21 9V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V9C3 8.44772 3.44772 8 4 8H6V7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7V8ZM16 8V7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V8H16ZM11 14V16H13V14H11ZM7 14V16H9V14H7ZM15 14V16H17V14H15Z"></path>
                            </svg>
                        </span>
                        <h3 class="fpg-modal-title">
                            Fancy Post Grid
                            <span class="badge-pro">PRO</span>
                        </h3>
                    </div>
                    <div class="fpg-modal-body">
                        <p>Unlock premium grid styles and advanced layouts!</p>
                        <p><strong>Style 4–12 are available only in the PRO version.</strong></p>
                    </div>
                    <div class="fpg-modal-footer">
                        <a href="https://rstheme.com/product/fancy-post-grid/"
                            class="fpg-pro-btn" target="_blank" rel="noopener noreferrer">
                            <span>🚀</span> Get Pro Version
                        </a>
                    </div>
                </div>
            </div>
        `);
    }

    // Lock logic for Gutenberg SelectControl
    function lockStyleSelect(select) {
        if (select.dataset.fpgLocked) return;
        select.dataset.fpgLocked = "true";

        // Add 🔒 to PRO styles
        [...select.options].forEach(option => {
            if (proValues.includes(option.value) && !option.text.includes("🔒")) {
                option.text += " 🔒 Pro";
            }
        });

        // Handle selection
        select.addEventListener("change", function () {
            if (proValues.includes(select.value)) {
                $('#fpg-pro-modal').fadeIn();
                select.value = "style1"; // fallback
                select.dispatchEvent(new Event("change")); // Ensure Gutenberg updates attribute
            }
        });
    }

    // Watch for dynamic Gutenberg DOM
    const observer = new MutationObserver(() => {
        document.querySelectorAll('.fpg-style-select-control select')
            .forEach(lockStyleSelect);
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Initial run
    document.querySelectorAll('.fpg-style-select-control select')
        .forEach(lockStyleSelect);

    // Close modal on click or ESC
    $(document).on('click', '.fpg-modal-close, #fpg-pro-modal', function (e) {
        if ($(e.target).is('#fpg-pro-modal') || $(e.target).is('.fpg-modal-close')) {
            $('#fpg-pro-modal').fadeOut();
        }
    });

    $(document).on('keydown', function (e) {
        if (e.key === "Escape") {
            $('#fpg-pro-modal').fadeOut();
        }
    });

});
