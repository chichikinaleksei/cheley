import VideoBackground from '../../../js/src/__utils/VideoBackground';
import VideoLightbox from '../../../js/src/__utils/VideoLightbox';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		VideoBackground.init();
		VideoLightbox.init();
	},
	loaded() {},
	resized() {
		VideoBackground.resized();
	},
	scrolled() {},
	keyDown(e) {
		VideoLightbox.keyDown(e);
	},
	mouseUp() {},
};
export default controller;
 