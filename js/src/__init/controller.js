import Accordion from '../__shortcodes/accordions';
import mirrorHover from '../__utils/mirrorHover';
import Video from '../__utils/video';
import smoothScroll from '../__utils/smoothScroll';
import Tables from '../__utils/tables';
import forms from '../__utils/forms';
import vhUnit from '../__utils/vhUnit';
import AlertBar from '../__header/AlertBar';
import Header from '../__header/Header';

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		document.querySelector('html').classList.remove('no-js');
		Header.init();
		Accordion.init();
		Video.init();
		mirrorHover();
		smoothScroll();
		Tables.init();
		vhUnit();
		AlertBar();
	},
	loaded() {
		document.querySelector('body').classList.add('page-has-loaded');
		vhUnit();
	},
	resized() {
		Tables.toggleShadow();
		vhUnit();
		Header.resized();
	},
	scrolled() {
	},
	keyDown() {},
	mouseUp(e) {
		Header.outSideClick(e);
	},
	orientationChange() {
		Header.orientation();
	},
	gformRender() {
		forms();
	},
};
export default controller;
