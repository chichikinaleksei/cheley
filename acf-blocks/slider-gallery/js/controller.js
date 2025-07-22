import { SimpleSlider, FluidSlider } from '../../../js/src/__utils/sliders';
import GalleryLightbox from '../../../js/src/__page/lightboxGallery';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		SimpleSlider.init();
		FluidSlider.init();
		GalleryLightbox.init();
	},
	loaded() {},
	resized() {
		GalleryLightbox.refreshSlider();
	},
	scrolled() {},
	keyDown() {},
	mouseUp() {},
};
export default controller;
