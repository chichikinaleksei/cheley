import Header from "../__header/Header";

const $ = jQuery.noConflict();
function scrollFunc(e) {
	e.preventDefault();
	const header = $('.main-header');
	const inpageNav = $('.inpage-nav');
	const inpageNavHeight = inpageNav.length > 0 ? inpageNav.outerHeight() : 0;
	const target = $($(this).attr('href'));
	const stickyHeight = header.outerHeight() + inpageNavHeight;
	if (
		$(this).attr('href') === '#next' &&
		$(this).parents('section').next().length > 0
	) {
		// Smooth Scroll to next section
		$('html, body').animate(
			{
				scrollTop:
					$(this).parents('section').next().offset().top -
					stickyHeight,
			},
			600
		);
		Header.hideWrapper();
	} else if (target.length) {
		$('html, body').animate(
			{
				scrollTop: target.offset().top - stickyHeight,
			},
			600
		);
		Header.hideWrapper();
	}
}
function smoothScroll() {
	$('a[href^="#"]:not([href="#"])').on('click', scrollFunc);
}
export default smoothScroll;
