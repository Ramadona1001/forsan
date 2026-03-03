$(document).ready(function () {
    $(document).on('submit', '.ajax-form', function (e) {
        e.preventDefault();
        var form = $(this);
        var btn = form.find('button[type="submit"]');
        var type = form.data('type'); // wishlist or compare

        // Visual feedback immediately (optional) - or wait for success
        var originalHtml = btn.html();
        btn.prop('disabled', true);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function (response) {
                btn.prop('disabled', false);

                if (response.status === 'success') {
                    // Update header badges (works on home and all pages)
                    if (type === 'wishlist') {
                        $('[data-ajax-badge="wishlist"] .badge').text(response.count);
                    } else if (type === 'compare') {
                        $('[data-ajax-badge="compare"] .badge').text(response.count);
                    }

                    // Toggle button state – الألوان من card-actions.css موحدة في كل الموقع
                    if (response.action === 'added') {
                        btn.addClass('active added-favorites');
                    } else {
                        btn.removeClass('active added-favorites');
                    }

                    console.log(response.message);
                }
            },
            error: function (xhr) {
                btn.prop('disabled', false);
                console.error("Error:", xhr.responseText);
                // Fallback to normal submit ?
                // form.off('submit').submit();
            }
        });
    });
});
