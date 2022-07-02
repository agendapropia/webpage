$(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:3,
        itemsDesktop:[1000,4],
        itemsDesktopSmall:[980,3],
        itemsTablet:[768,2],
        pagination:true,
        navigation:true,
        navigationText:["<",">"],
        autoPlay:true
    });
});