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