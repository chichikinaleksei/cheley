import lockScroll from '../__utils/lockScroll';

const $ = jQuery.noConflict();

class VideoGallery {
	constructor() {
		this.lightboxOpen = $('.video-gallery__card');
		this.lightboxClose = $('.video-gallery__close');
	}

	init() {
		if (!$('.block-video-gallery').length) {
			return;
		}

		this.bindEvents();
	}

	bindEvents() {
		this.lightboxOpen.on('click', this.openLightbox);
		this.lightboxClose.on('click', this.closeLightbox);
	}

	openLightbox(e) {
		e.preventDefault();
		const id = e.currentTarget.getAttribute('data-id');
		const embedUrl = e.currentTarget.getAttribute('data-embed-url');
		const ratio = e.currentTarget.getAttribute('data-ratio');
		const lightbox = $(`#video-gallery-lightbox-${id}`);

		lightbox
			.find('.video-gallery__iframe-wrapper')
			.css('padding-top', `${ratio}%`);
		lightbox.find('iframe').attr('src', embedUrl);

		lightbox.addClass('active').attr('aria-hidden', 'false');
		lockScroll.lock();
	}

	closeLightbox() {
		const lightbox = $(this).parent('.video-gallery__lightbox');
		lightbox.find('iframe').attr('src', '');
		lightbox.removeClass('active').attr('aria-hidden', 'true');
		lockScroll.unlock();
	}
}
export default new VideoGallery();
