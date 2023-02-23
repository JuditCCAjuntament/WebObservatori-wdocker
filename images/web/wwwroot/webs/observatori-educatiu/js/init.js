$(document).ready(function(){
    $('select').formSelect();
    $('.sidenav').sidenav();
    $('.tooltipped').tooltip();
    $('.tabs').tabs();
    $('.collapsible').collapsible();
    $('.modal').modal();
    optionsSlider = {
        height: '200'
    }
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators:true
    });
    setTimeout(autoplayCarousel, 9000);
    setTimeout(rectificarMida, 1000);

    $('.contingut img').addClass('responsive-img');
    $('.contingut iframe').addClass('width100');

    //segons les versions del Chrome no colora bé els anchors
    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    if (window.location.hash && isChrome) {
        setTimeout(function () {
            var hash = window.location.hash;
            window.location.hash = "";
            window.location.hash = hash;
        }, 300);
    }
});

function autoplayCarousel() {
    rectificarMida()
    // $('#BigImg').height($(".carousel-item > img").innerHeight());
    $('.carousel.autoplay').carousel('next');
    setTimeout(autoplayCarousel, 9000);

}

function rectificarMida() {
    $('.carousel.carousel-slider').height($(".carousel-item a > img").innerHeight());
}

function acceptarCookies() {
    const d = new Date();
    d.setTime(d.getTime() + (365*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = "avis_cookie_74=1;" + expires + ";path=/";
    $('#barracookies').hide()
}

