/**
 * IOI Content Manager - Admin JavaScript
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        initImageUploads();
        initTranslationInputs();
        initDeleteTier();
    });

    /**
     * Media Library Image Uploads
     */
    function initImageUploads() {
        $('.ioi-image-upload').each(function() {
            var $container = $(this);
            var $input = $container.find('input[type="hidden"]');
            var $uploadBtn = $container.find('.upload-image');
            var $removeBtn = $container.find('.remove-image');

            $uploadBtn.on('click', function(e) {
                e.preventDefault();

                var frame = wp.media({
                    title: 'Select Image',
                    multiple: false,
                    library: { type: 'image' }
                });

                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $input.val(attachment.id);
                    
                    // Update preview
                    var $img = $container.find('img');
                    if ($img.length) {
                        $img.attr('src', attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url);
                    } else {
                        $container.prepend('<img src="' + (attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url) + '" style="max-width: 100px;">');
                    }
                });

                frame.open();
            });

            $removeBtn.on('click', function(e) {
                e.preventDefault();
                $input.val('');
                $container.find('img').remove();
            });
        });
    }

    /**
     * Auto-save Translation Inputs
     */
    function initTranslationInputs() {
        var saveTimeout = {};

        $('.translation-input').on('input', function() {
            var $input = $(this);
            var stringId = $input.data('id');
            var lang = $input.data('lang');
            var value = $input.val();

            // Clear existing timeout
            if (saveTimeout[stringId]) {
                clearTimeout(saveTimeout[stringId]);
            }

            // Debounce save
            saveTimeout[stringId] = setTimeout(function() {
                $.ajax({
                    url: ioiAdmin.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'ioi_save_translation',
                        nonce: ioiAdmin.nonce,
                        string_id: stringId,
                        lang: lang,
                        content: value
                    },
                    success: function(response) {
                        $input.css('border-color', '#46b450');
                        setTimeout(function() {
                            $input.css('border-color', '');
                        }, 1000);
                    },
                    error: function() {
                        $input.css('border-color', '#dc3232');
                    }
                });
            }, 800);
        });
    }

    /**
     * Delete Pricing Tier
     */
    function initDeleteTier() {
        $('.delete-tier').on('click', function(e) {
            e.preventDefault();
            
            var $btn = $(this);
            var tier = $btn.data('tier');
            
            if (!confirm('Delete tier "' + tier + '"? This cannot be undone.')) {
                return;
            }

            $.ajax({
                url: ioiAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'ioi_delete_pricing_tier',
                    nonce: ioiAdmin.nonce,
                    tier: tier
                },
                success: function(response) {
                    if (response.success) {
                        $btn.closest('tr').fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                }
            });
        });
    }

})(jQuery);
