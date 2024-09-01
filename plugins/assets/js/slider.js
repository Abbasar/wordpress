document.addEventListener('DOMContentLoaded', function () {
    const sliders = document.querySelectorAll('.wps-slider-wrapper');

    sliders.forEach(function(wrapper) {
        const slider = wrapper.querySelector('.wps-slider');
        const prevArrow = wrapper.querySelector('.wps-prev');
        const nextArrow = wrapper.querySelector('.wps-next');
        const slideWidth = wrapper.querySelector('.wps-slide').offsetWidth; // Width of one slide

        if (slider && prevArrow && nextArrow) {
            prevArrow.addEventListener('click', function() {
                slider.scrollBy({
                    top: 0,
                    left: -slideWidth,  // Scroll by the width of one slide
                    behavior: 'smooth'
                });
            });

            nextArrow.addEventListener('click', function() {
                slider.scrollBy({
                    top: 0,
                    left: slideWidth,  // Scroll by the width of one slide
                    behavior: 'smooth'
                });
            });
        }
    });

    jQuery(document.body).on('added_to_cart', function(event, fragments, cart_hash, button) {
        var addToCartBtn = jQuery(button);

        // Create a new "View cart" button
        var viewCartBtn = jQuery('<a href="/cart" class="wps-view-cart">View cart</a>');

        // Preserve the button's dimensions and position
        viewCartBtn.css({
            'display': 'inline-block',
            'width': addToCartBtn.outerWidth(),
            'height': addToCartBtn.outerHeight(),
            'line-height': addToCartBtn.css('line-height'),
            'text-align': addToCartBtn.css('text-align'),
            'opacity': '0',
            'transition': 'opacity 0.3s ease-in-out'
        });

        // Replace the existing button with the new one
        addToCartBtn.replaceWith(viewCartBtn);

        // Animate the new button smoothly
        setTimeout(function() {
            viewCartBtn.css('opacity', '1');
        }, 10);
    });
});
