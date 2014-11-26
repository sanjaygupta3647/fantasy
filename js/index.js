$(document).ready(function(){
    $('#latest-works').bxSlider({
        hideControlOnEnd: true,
        minSlides: 1,
        maxSlides: 100,
        slideWidth: 98,
        slideMargin: 30,
        pager: false,
        nextSelector: '#bx-next4',
        prevSelector: '#bx-prev4',
        nextText: '>',
        prevText: '<'
    });

    $('#home-block').bxSlider({
        hideControlOnEnd: true,
        minSlides: 1,
        maxSlides: 1,

        pager: false,
        nextSelector: '#bx-next5',
        prevSelector: '#bx-prev5',
        nextText: '>',
        prevText: '<',
    })
});
