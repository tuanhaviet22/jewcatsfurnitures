$(window).scroll(function(){
    if($(window).scrollTop() >= 10) {
        $('#btn-scroll-to-top').show();
    } else {
        $('#btn-scroll-to-top').hide();
    }
});

function scrollToTop(){
    $('html,body').animate({
        scrollTop: 0
    }, 'fast');
}