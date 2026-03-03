/*
 * Knights - Main JavaScript
 * خطى الفرسان
 */

$(document).ready(function () {
    // Initialize Fancybox
    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind("[data-fancybox]", {});
    }

    // Auto-hide alerts
    setTimeout(function () {
        $('.alert-dismissible').fadeOut(500);
    }, 5000);

    // Add to cart animation
    $('form[action*="cart/add"]').on('submit', function (e) {
        var btn = $(this).find('button[type="submit"]');
        var originalText = btn.html();
        btn.html('<i class="bi bi-check me-1"></i>تمت الإضافة').addClass('btn-success').removeClass('btn-primary');
        setTimeout(function () {
            btn.html(originalText).addClass('btn-primary').removeClass('btn-success');
        }, 2000);
    });

    // Smooth scroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = $(this.hash);
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });

    // Sticky header shadow
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $('.main-header').addClass('shadow');
        } else {
            $('.main-header').removeClass('shadow');
        }
    });

    // Quantity buttons
    $('.quantity-minus').on('click', function () {
        var input = $(this).siblings('input');
        var value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1).trigger('change');
        }
    });

    $('.quantity-plus').on('click', function () {
        var input = $(this).siblings('input');
        var value = parseInt(input.val());
        input.val(value + 1).trigger('change');
    });

    // Mobile search toggle
    $('.mobile-search-toggle').on('click', function () {
        $('.mobile-search-form').toggleClass('d-none');
    });

    // Lazy load images
    if ('IntersectionObserver' in window) {
        var lazyImages = document.querySelectorAll('img[data-src]');
        var imageObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        lazyImages.forEach(function (img) {
            imageObserver.observe(img);
        });
    }

    // Form validation
    $('form').on('submit', function () {
        var form = this;
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        $(form).addClass('was-validated');
    });

    // Confirm delete
    $('[data-confirm]').on('click', function (e) {
        if (!confirm($(this).data('confirm') || 'هل أنت متأكد؟')) {
            e.preventDefault();
        }
    });
});
