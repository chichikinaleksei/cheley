import InpageNav from '../../../js/src/__utils/inpagenav';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		InpageNav.init();
	},
	loaded() {},
	resized() {},
	scrolled() {
		InpageNav.scrollSpy();
	},
	keyDown() {},
	mouseUp() {},
};
export default controller;
