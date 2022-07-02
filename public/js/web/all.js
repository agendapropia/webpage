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
document.addEventListener('DOMContentLoaded', function () {
	var splide = new Splide('.splide-video');
	splide.mount();
});
const swiper = new Swiper('.swiper-hero', {
	direction: 'horizontal',
	loop: true,
	autoplay: {
		delay: 3000,
	  },
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	effect: 'fade',
	fadeEffect: {
	  crossFade: true
	},
});
const MAX_SCROLL_HEIGHT = 300;

const hamburger = document.querySelector('.navbar__hamburger');
const body = document.querySelector('body');
const header = document.querySelector('.navbar-web');


hamburger.addEventListener('click', () => {
	hamburger.classList.toggle('navbar__hamburger--active');
	body.style.overflow = body.style.overflow === 'hidden' ? '' : 'hidden';
	header.classList.remove('navbar--scrolled');
})

/**
 * CHANGE BACKGROUND COLOR ON SCROLL
 */
const handleScrollHeader = () => {
	if (window.scrollY > MAX_SCROLL_HEIGHT) {
		header.classList.add('navbar--scrolled');
	} else {
		header.classList.remove('navbar--scrolled');
	}
}

window.addEventListener('scroll', handleScrollHeader);
const MAX_SCROLL_HEIGHT_SOCIAL_MEDIA = 432;
const SCREEN_MD = 768;

const socialMedia = document.querySelector('.social-media');

/**
 * CHANGE BACKGROUND COLOR ON SCROLL
 */
const handleScrollSocialMedia = () => {
	if (window.innerWidth >= SCREEN_MD && window.scrollY > MAX_SCROLL_HEIGHT_SOCIAL_MEDIA) {
		socialMedia.classList.add('social-media--scrolled');
	} else {
		socialMedia.classList.remove('social-media--scrolled');
	}
}

window.addEventListener('scroll', handleScrollSocialMedia);