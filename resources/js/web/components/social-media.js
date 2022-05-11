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