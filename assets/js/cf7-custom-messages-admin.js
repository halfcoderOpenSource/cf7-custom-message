/**
 * CF7 Custom Validation Messages - Admin Scripts
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        /**
         * Initialize custom messages functionality
         */
        function initCustomMessages() {
            // Add placeholder animation on focus
            $('.cf7-custom-messages-table input[type="text"]').on('focus', function() {
                $(this).parent().parent().addClass('focused-row');
            }).on('blur', function() {
                $(this).parent().parent().removeClass('focused-row');
            });

            // Add change detection
            let originalValues = {};
            
            $('.cf7-custom-messages-table input[type="text"]').each(function(index) {
                const fieldName = $(this).attr('name');
                originalValues[fieldName] = $(this).val();
            });

            // Detect changes
            $('.cf7-custom-messages-table input[type="text"]').on('change', function() {
                const fieldName = $(this).attr('name');
                const currentValue = $(this).val();
                
                if (originalValues[fieldName] !== currentValue) {
                    $(this).addClass('changed');
                } else {
                    $(this).removeClass('changed');
                }
            });

            // Add clear button functionality
            addClearButtons();
            
            // Add counter for filled messages
            updateMessageCounter();
            
            $('.cf7-custom-messages-table input[type="text"]').on('input', function() {
                updateMessageCounter();
            });
        }

        /**
         * Add clear buttons to input fields
         */
        function addClearButtons() {
            $('.cf7-custom-messages-table input[type="text"]').each(function() {
                if ($(this).val() && !$(this).next('.clear-message').length) {
                    const clearBtn = $('<button type="button" class="clear-message" title="Clear message">×</button>');
                    $(this).after(clearBtn);
                }
            });

            // Handle clear button clicks
            $(document).on('click', '.clear-message', function(e) {
                e.preventDefault();
                $(this).prev('input').val('').trigger('change').focus();
                $(this).remove();
                updateMessageCounter();
            });

            // Show/hide clear button on input
            $('.cf7-custom-messages-table input[type="text"]').on('input', function() {
                if ($(this).val() && !$(this).next('.clear-message').length) {
                    const clearBtn = $('<button type="button" class="clear-message" title="Clear message">×</button>');
                    $(this).after(clearBtn);
                } else if (!$(this).val() && $(this).next('.clear-message').length) {
                    $(this).next('.clear-message').remove();
                }
            });
        }

        /**
         * Update counter showing how many custom messages are defined
         */
        function updateMessageCounter() {
            let count = 0;
            
            $('.cf7-custom-messages-table input[type="text"]').each(function() {
                if ($(this).val().trim() !== '') {
                    count++;
                }
            });

            // Remove existing counter
            $('.cf7-custom-messages-counter').remove();

            // Add counter if messages exist
            if (count > 0) {
                const total = $('.cf7-custom-messages-table input[type="text"]').length;
                const counterHtml = '<div class="cf7-custom-messages-counter">' +
                    '<strong>' + count + '</strong> of <strong>' + total + '</strong> fields have custom messages' +
                    '</div>';
                $('.cf7-custom-messages-wrapper h2').after(counterHtml);
            }
        }

        /**
         * Add warning before leaving if there are unsaved changes
         */
        function setupChangeDetection() {
            let formChanged = false;

            $('.cf7-custom-messages-table input[type="text"]').on('change', function() {
                formChanged = true;
            });

            // Reset on form submit
            $('#wpcf7-admin-form-element').on('submit', function() {
                formChanged = false;
            });

            // Warn before leaving
            $(window).on('beforeunload', function() {
                if (formChanged) {
                    return 'You have unsaved changes. Are you sure you want to leave?';
                }
            });
        }

        /**
         * Add search/filter functionality
         */
        function addSearchFilter() {
            if ($('.cf7-custom-messages-table tbody tr').length > 5) {
                const searchHtml = '<div class="cf7-messages-search">' +
                    '<input type="text" id="cf7-messages-filter" placeholder="Filter fields..." class="regular-text" />' +
                    '</div>';
                
                $('.cf7-custom-messages-table').before(searchHtml);

                $('#cf7-messages-filter').on('keyup', function() {
                    const searchText = $(this).val().toLowerCase();
                    
                    $('.cf7-custom-messages-table tbody tr').each(function() {
                        const fieldName = $(this).find('td:first strong').text().toLowerCase();
                        const fieldType = $(this).find('.field-type-badge').text().toLowerCase();
                        
                        if (fieldName.includes(searchText) || fieldType.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            }
        }

        // Initialize on page load
        if ($('.cf7-custom-messages-wrapper').length) {
            initCustomMessages();
            setupChangeDetection();
            addSearchFilter();
        }

        // Re-initialize when CF7 tab is clicked (in case of AJAX loading)
        $(document).on('click', '#custom-messages-panel-tab', function() {
            setTimeout(function() {
                if ($('.cf7-custom-messages-wrapper').length) {
                    initCustomMessages();
                    setupChangeDetection();
                    addSearchFilter();
                }
            }, 100);
        });
    });

})(jQuery);

