import ActivitiesLightbox from "../../../js/src/__page/activitiesLightbox";
import { ActivitiesSlider, ActivitiesLightboxSlider } from '../../../js/src/__utils/sliders';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		ActivitiesSlider.init();
		ActivitiesLightbox.init();
		ActivitiesLightboxSlider.init();
	},
	loaded() {},
	resized() {},
	scrolled() {},
	keyDown() {},
	mouseUp() {},
};
export default controller;
