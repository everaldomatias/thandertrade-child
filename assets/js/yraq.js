jQuery(function() {
    jQuery('.add-request-quote-button').on('click', function() {
        jQuery.ajax({
            type   : 'POST',
            url    : 'wp-admin/admin-ajax.php',
            dataType: 'json',
            data   : action_agp_qdt_itens,
            success: function (response) {
                jQuery('#raq_item_number').addClass('teste');
            }
        });

    });
});
