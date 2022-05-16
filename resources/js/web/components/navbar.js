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