const $ = jQuery.noConflict();

class Slider {
	constructor(selector, args = {}) {
		this.selector = selector;
		this.args = args;
	}

	getDefaultSlickSettings() {
		return {
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			pauseOnHover: false,
			speed: 600,
		};
	}

	/**
	 * Override our default slick settings with args provided to the class.
	 */
	getSlickSettings() {
		return Object.assign({}, this.getDefaultSlickSettings(), this.args);
	}

	init() {
		const settings = this.getSlickSettings();

		$(this.selector).slick(settings);

		if (
			this.selector ===
				".block-slider-gallery--hard .gallery-slider__slider-fluid" ||
			this.selector ===
				"block-slider-gallery--flexible .gallery-slider__slider-fluid"
		) {
			const slideLink = document.querySelectorAll("[data-slide-id]");

			slideLink.forEach((e) => {
				e.addEventListener("click", () => {
					const slideId = e.dataset.slideId;
					$(this.selector).slick("slickGoTo", slideId);
				});
			});
		}
	}

	resized() {
		if (
			window.matchMedia(`(max-width: 991px)`).matches &&
			!$(this.selector).hasClass("slick-initialized")
		) {
			this.init();
		}
	}
}

const SimpleSlider = new Slider(".gallery-slider__slider");
const TestimonialSlider = new Slider(".testimonial-slider", {
	arrows: false,
	dots: true,
});

const FluidSlider = new Slider(
	".block-slider-gallery--hard .gallery-slider__slider-fluid",
	{
		centerMode: true,
		variableWidth: true,
	}
);

const FlexibleSlider = new Slider(
	".block-slider-gallery--flexible .gallery-slider__slider-fluid",
	{
		centerMode: true,
		variableWidth: true,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					centerMode: false,
					variableWidth: false,
				},
			},
		],
	}
);

const EnrollmentSlider = new Slider(".block-enrollment-countdown__counters", {
	mobileFirst: true,
	arrows: false,
	slide: ".block-enrollment-countdown__counter-wrapper",
	centerMode: true,
	variableWidth: true,
	centerPadding: false,
	responsive: [
		{
			breakpoint: 991,
			settings: "unslick",
		},
	],
});

const ActivitiesSlider = new Slider(".activities-lightbox__wrapper", {
	fade: true,
	swipe: false,
});

const ActivitiesLightboxSlider = new Slider(
	".activities-lightbox-item__slider",
	{
		dots: true,
		arrows: false,
		variableWidth: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					dots: false,
				},
			},
		],
	}
);

const IconDescriptionSlider = new Slider(".block-icon-descriptions__slider", {
	dots: true,
	arrows: false,
	adaptiveHeight: true,
	mobileFirst: true,
	responsive: [
		{
			breakpoint: 991,
			settings: "unslick",
		},
	],
});

const HighlightsSlider = new Slider(
	".block-activities-highlights__activities",
	{
		mobileFirst: true,
		arrows: false,
		centerMode: true,
		variableWidth: true,
		centerPadding: false,
		touchThreshold: 400,
		responsive: [
			{
				breakpoint: 1600,
				settings: "unslick",
			},
		],
	}
);

export {
	SimpleSlider,
	TestimonialSlider,
	FluidSlider,
	FlexibleSlider,
	EnrollmentSlider,
	ActivitiesSlider,
	ActivitiesLightboxSlider,
	IconDescriptionSlider,
	HighlightsSlider,
};
