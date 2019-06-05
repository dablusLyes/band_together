$(document).ready(function () {

    //======================================================================================
    //========================== Smooth scroll to anchor ===================================
    //======================================================================================

    // Select all links with hashes
    $('a[href*="#"]')
        // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 0, function () {
                        // // Callback after animation
                        // // Must change focus!
                        // var $target = $(target);
                        // $target.focus();
                        // if ($target.is(":focus")) { // Checking if the target was focused
                        //     return false;
                        // } else {
                        //     $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                        //     $target.focus(); // Set focus again
                        // };
                    });
                }
            }
        });

    //======================================================================================
    //================================== Collapse Menu =====================================
    //======================================================================================

    // Makes the collapse menu working and toggle visible and hide on links click

    let collapseMenu = $('#collapse_menu');
    let trigger = $('#trigger_collapse_menu');
    let links = $('#collapse_menu>ul>li>a');

    trigger.on('click', function () {
        collapseMenu.toggleClass('visible');
    })

    links.on('click', function () {
        collapseMenu.toggleClass('visible');
    })


});