import { EnrollmentSlider } from '../../../js/src/__utils/sliders';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		EnrollmentSlider.init();
	},
	loaded() {},
	resized() {
		EnrollmentSlider.resized();
	},
	scrolled() {},
	keyDown() {},
	mouseUp() {},
};
export default controller;
