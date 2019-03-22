$( document ).ready(function() {

    function scrollTo( target) {
        if( target.length ) {
            $("html, body").stop().animate( { scrollTop: target.offset().top }, 1000);
        }
    }

    var scrollTrigger = $('.fa-angle-double-down');
    var scrollTarget = $('.about');

    scrollTrigger.on('click', function () {
        scrollTo( scrollTarget );
    })



});