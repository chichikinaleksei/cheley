import { offsetFunction, getSiblings } from './customFunctions';
const $ = jQuery.noConflict();

class InpageNav {
    constructor() {
        this.subnav = document.querySelector('.inpage-nav');
        this.subnavItems = document.querySelectorAll('.inpage-nav__item');
        this.header = document.querySelector('.main-header');
        this.scrollLeft = 0;
        this.tabletViewport = window.matchMedia('screen and (max-width: 1199px)');
        this.mobileViewport = window.matchMedia('screen and (max-width: 767px)');
        this.ids =[];
    }

    init() {
        if (this.subnav) {
            [...this.subnavItems].forEach(item => {
                this.ids.push(item.hash);
                item.addEventListener('click', (e) => {
                    [...this.subnavItems].forEach(item => {
                        item.classList.remove('active');
                    })
                    e.target.classList.add('active');
                })
            })
        }
    }

    scrollSpy() {
        if (this.subnav) {
			const validIds = [];
			[...this.ids].forEach(item => {
				const validId = item.replace("#", "[id='") + "']";
				validIds.push(validId);
			});
            const scrollHooks = document.querySelectorAll(validIds);
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            let lastHook = null;
            const firstHook = scrollHooks[0];
            [...scrollHooks].forEach((hook, index) => {
                const elemOffset = offsetFunction(hook).top - this.subnav.offsetHeight - this.header.offsetHeight - 3;
                if (scrollPosition >= elemOffset) {
                    lastHook = hook;
                }
            });

            if (scrollPosition < offsetFunction(firstHook).top) {
                this.subnavItems[0].parentNode.classList.remove('active');
            }

            if (lastHook !== null) {
                const id = lastHook.getAttribute('id');
                const navElement = document.querySelector('a[href="#' + id + '"]');

                const navElementParent = navElement.parentNode;

                if (!navElementParent.classList.contains('active')) {
                    const navElementSiblings = getSiblings(navElementParent);
                    navElementParent.classList.add('active');
                    navElementSiblings.forEach(element => {
                        element.classList.remove('active');
                    })
                    this.menuScroll(navElement);
                }
            }
        }
    }

    menuScroll(el) {
        const navigationWrapper = $('.inpage-nav__list');
        let offsetValue = 310;

        if (this.tabletViewport.matches) {
            offsetValue = 39;
        } else if (this.mobileViewport.matches) {
            offsetValue = 20;
        }
        const offsetLeft = el.offsetLeft - offsetValue;
        navigationWrapper.animate({
            scrollLeft: offsetLeft,
        }, 100);
    }
}

export default new InpageNav();