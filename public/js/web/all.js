const swiperCards = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        950: {
            slidesPerView: 3,
        },
    },
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