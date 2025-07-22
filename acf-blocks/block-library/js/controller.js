import Sortable from 'sortablejs';

const pageContent = document.querySelector('.page-content');
const inputs = document.querySelectorAll('.block-library__input');
const navElement = document.querySelector('.block-library__nav');
const toggleButtons = document.querySelectorAll(
	'.block-library__toggle-button'
);
const hoverLabelsToggleButton = document.querySelector(
	'.block-library__hover-labels-toggle-button'
);
const blockLibrarySection = document.querySelector('.block-library');
const childElements = document.querySelectorAll('.page-content > *');

const toggleInputs = (e) => {
	e.preventDefault();

	if (e.currentTarget.hasAttribute('data-category')) {
		const categoryInputs = document.querySelectorAll(
			'ul[data-category="' +
				e.currentTarget.getAttribute('data-category') +
				'"] .block-library__input'
		);

		if (categoryInputs.length) {
			let checked = false;

			if (e.currentTarget.classList.contains('block-library__show-all')) {
				checked = true;
			}

			categoryInputs.forEach((input) => {
				input.checked = checked;
			});

			changeInput();
		}
	}
};

const changeInput = () => {
	const url = new URL(window.location);

	if (
		hoverLabelsToggleButton &&
		hoverLabelsToggleButton.classList.contains('active')
	) {
		url.searchParams.append('hide-hover-labels', '1');
	} else {
		url.searchParams.delete('hide-hover-labels');
	}

	inputs.forEach((input) => {
		const name = input.getAttribute('name');
		url.searchParams.delete(name);

		if (input.checked) {
			blockLibrarySection.classList.add('visible-' + name);
			url.searchParams.append(name, 'v');
		} else {
			blockLibrarySection.classList.remove('visible-' + name);
			url.searchParams.append(name, 'h');
		}
	});

	window.history.pushState({}, '', url);
};

const hoverLabelsToggle = (e) => {
	if (e.currentTarget.classList.contains('active')) {
		e.currentTarget.classList.remove('active');
		blockLibrarySection.classList.remove('hide-hover-labels');
	} else {
		e.currentTarget.classList.add('active');
		blockLibrarySection.classList.add('hide-hover-labels');
	}

	changeInput();
};

// GLOBAL APP CONTROLLER
const controller = {
	init() {
		if (childElements.length) {
			let blockID = '';
			let blockTitle = '';

			childElements.forEach((childElement) => {
				if (
					childElement.classList.contains(
						'block-library__section-placeholder'
					)
				) {
					blockID = childElement.getAttribute('data-block-id');
					blockTitle = childElement.getAttribute('data-block-title');
					childElement.remove();
				} else {
					childElement.setAttribute('data-block-id', blockID);
					childElement.setAttribute('data-block-title', blockTitle);
				}
			});
		}

		if (pageContent && navElement) {
			Sortable.create(pageContent, {
				filter: '.block-library, .block-library__hero',
				onMove(evt) {
					if (
						evt.related.classList.contains('block-library') ||
						evt.related.classList.contains('block-library__hero')
					) {
						return false;
					}
				},
			});
		}

		if (inputs.length && blockLibrarySection) {
			inputs.forEach((input) => {
				input.addEventListener('change', changeInput);
			});
		}

		if (toggleButtons.length && blockLibrarySection) {
			toggleButtons.forEach((toggleButton) => {
				toggleButton.addEventListener('click', toggleInputs);
			});
		}

		if (hoverLabelsToggleButton && blockLibrarySection) {
			hoverLabelsToggleButton.addEventListener(
				'click',
				hoverLabelsToggle
			);
		}
	},
	loaded() {},
	resized() {},
	scrolled() {},
	keyDown() {},
	mouseUp() {},
};
export default controller;
