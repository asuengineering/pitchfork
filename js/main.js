jQuery(function ($) { // DOM is ready

    // If window is not top then display button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('#scroll-to-top').fadeIn();
        } else {
            $('#scroll-to-top').fadeOut();
        }
    });

    // Click event to scroll to top
    $('#scroll-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 150);
        return false;
    });

}) // End of jQuery and this file
