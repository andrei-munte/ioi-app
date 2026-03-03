/**
 * IOI Content Manager - Admin JavaScript
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        
        // ========================================
        // Media Upload Handling
        // ========================================
        $('.ioi-upload-btn').on('click', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var targetInput = $(button.data('target'));
            var previewImg = button.siblings('.ioi-image-preview').find('img');
            
            var mediaUploader = wp.media({
                title: 'Select Image',
                button: { text: 'Use This Image' },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                
                if (previewImg.length) {
                    previewImg.attr('src', attachment.url).show();
                }
            });
            
            mediaUploader.open();
        });

        // ========================================
        // Translation Auto-Save
        // ========================================
        var saveTimeout;
        $('.translation-input').on('input', function() {
            var input = $(this);
            var section = input.data('section');
            var key = input.data('key');
            var lang = input.data('lang');
            var value = input.val();
            
            clearTimeout(saveTimeout);
            
            input.css('border-color', '#f0ad4e'); // Yellow while typing
            
            saveTimeout = setTimeout(function() {
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'ioi_save_translation',
                        nonce: ioiAdmin.nonce,
                        section: section,
                        key: key,
                        lang: lang,
                        value: value
                    },
                    success: function(response) {
                        if (response.success) {
                            input.css('border-color', '#5cb85c'); // Green on success
                            setTimeout(function() {
                                input.css('border-color', '');
                            }, 2000);
                        } else {
                            input.css('border-color', '#d9534f'); // Red on error
                        }
                    },
                    error: function() {
                        input.css('border-color', '#d9534f');
                    }
                });
            }, 1000); // Wait 1 second after typing stops
        });

        // ========================================
        // Pricing Tier Edit Functionality
        // ========================================
        
        // Edit tier button click
        $(document).on('click', '.edit-tier-btn', function(e) {
            e.preventDefault();
            
            var btn = $(this);
            var row = btn.closest('tr');
            
            // Get data from the row
            var tierCode = row.data('tier-code') || btn.data('tier');
            var tierName = row.find('td:eq(0)').text().trim().split('\n')[0].trim();
            var priceText = row.find('td:eq(1)').text().trim();
            var price = priceText.replace('$', '').replace('/mo', '').trim();
            var budgetText = row.find('td:eq(2)').text().trim();
            var budget = budgetText.replace('$', '').replace(',', '').trim();
            var maxBots = row.find('td:eq(3)').text().trim();
            
            // Get features from the features column
            var featuresHtml = row.find('td:eq(4)').html();
            var features = '';
            if (featuresHtml) {
                var featureLines = featuresHtml.split('<br>');
                features = featureLines.map(function(f) {
                    return f.replace(/<[^>]*>/g, '').trim();
                }).filter(function(f) {
                    return f.length > 0;
                }).join('\n');
            }
            
            // Check if popular
            var isPopular = row.find('.popular-badge, .ioi-badge').length > 0 || 
                           row.html().toLowerCase().indexOf('popular') > -1;
            
            // Populate the form
            $('#tier_code').val(tierCode).prop('readonly', true);
            $('#tier_name').val(tierName);
            $('#tier_price').val(price);
            $('#tier_budget').val(budget);
            $('#tier_max_bots').val(maxBots);
            $('#tier_features').val(features);
            $('#tier_popular').prop('checked', isPopular);
            
            // Change form mode to edit
            $('#tier-form-mode').val('edit');
            $('#tier-form-title').text('Edit Tier: ' + tierName);
            $('#tier-submit-btn').val('Update Tier');
            $('#tier-cancel-btn').show();
            
            // Scroll to form
            $('html, body').animate({
                scrollTop: $('#tier-form').offset().top - 50
            }, 300);
            
            // Highlight the form
            $('#tier-form').css('background-color', '#2a2a1a').animate({
                backgroundColor: '#1a1a1a'
            }, 1000);
        });
        
        // Cancel edit
        $(document).on('click', '#tier-cancel-btn', function(e) {
            e.preventDefault();
            resetTierForm();
        });
        
        // Reset tier form to add mode
        function resetTierForm() {
            $('#tier_code').val('').prop('readonly', false);
            $('#tier_name').val('');
            $('#tier_price').val('');
            $('#tier_budget').val('');
            $('#tier_max_bots').val('');
            $('#tier_features').val('');
            $('#tier_popular').prop('checked', false);
            
            $('#tier-form-mode').val('add');
            $('#tier-form-title').text('Add New Tier');
            $('#tier-submit-btn').val('Add Tier');
            $('#tier-cancel-btn').hide();
            
            $('#tier-form').css('background-color', '');
        }

        // ========================================
        // Delete Tier Confirmation
        // ========================================
        $(document).on('click', '.delete-tier-btn', function(e) {
            var tierName = $(this).closest('tr').find('td:first').text().trim().split('\n')[0];
            if (!confirm('Are you sure you want to delete the "' + tierName + '" tier?')) {
                e.preventDefault();
            }
        });

        // ========================================
        // FAQ Accordion Preview
        // ========================================
        $('.faq-preview-toggle').on('click', function() {
            $(this).next('.faq-preview-content').slideToggle();
            $(this).find('.toggle-icon').text(function(i, text) {
                return text === '+' ? '−' : '+';
            });
        });

        // ========================================
        // Form Validation
        // ========================================
        $('form.ioi-admin-form').on('submit', function(e) {
            var form = $(this);
            var isValid = true;
            
            // Check required fields
            form.find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    $(this).css('border-color', '#d9534f');
                    isValid = false;
                } else {
                    $(this).css('border-color', '');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });

        // ========================================
        // Initialize
        // ========================================
        
        // Hide cancel button on page load
        $('#tier-cancel-btn').hide();
        
        // Add data attributes to tier rows for easier editing
        $('.ioi-tier-table tbody tr').each(function() {
            var firstCell = $(this).find('td:first');
            var badge = firstCell.find('.ioi-badge, code');
            if (badge.length) {
                $(this).attr('data-tier-code', badge.text().trim());
            }
        });

    });

})(jQuery);