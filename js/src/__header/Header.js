const $ = jQuery.noConflict();

import lockScroll from '../__utils/lockScroll';
class Header {
    constructor() {
        this.header = document.querySelector('.main-header');
        this.trigger = document.querySelector('.btn-hamburger');
        this.overlay = document.querySelector('.main-header__overlay');
        this.headerContainer = document.querySelector('.main-header__bottom');
        this.megaMenuLinks = document.querySelectorAll('.menu-item-object-ccs_custom_menu_item > a');
        this.megaMenuLinksSecondLevel = document.querySelectorAll('.mega-menu-title-trigger');
        this.prevButton = document.querySelectorAll('.main-header__back');
        this.desktopViewport = window.matchMedia('screen and (max-width: 1199px)');
        this.mobileViewport = window.matchMedia('screen and (max-width: 767px)');
        this.stepsButtons = document.querySelectorAll('.main-header__steps-button');
        this.mobileTitle = document.querySelectorAll('.main-header__mobile-title');
        this.stepMobileWrapper = document.querySelector('.main-header__overlay .main-header__steps');
        this.stepMenuWrapper = document.querySelector('.main-header__steps-menu-wrapper');
        this.body = document.querySelector('body');
        this.alertBar = document.querySelector('.main-header .alert-bar');
        this.headerRight = document.querySelector('.main-header__right');
    }

    init() {
        if (!this.header) return;

        this.trigger.addEventListener('click', (e) => this.setNavState(e));

        [...this.stepsButtons].forEach(button => {
            button.addEventListener('click', (e) => this.stepsMenuToggle(e))
        });

        [...this.megaMenuLinks].forEach(link => {
            link.addEventListener('click', (e) => this.megaMenuToggle(e))
        });

        [...this.megaMenuLinksSecondLevel].forEach(link => {
            link.addEventListener('click', (e) => this.megaMenuSecondLevelToggle(e))
        });

        if (this.prevButton) {
            [...this.prevButton].forEach(button => {
                button.addEventListener('click', (e) => this.mobileMenuReset())
            });
        }

        this.HeaderVars();
    }

    setNavState(e) {
        e.preventDefault();
        if (this.header.classList.contains('open')) {
            this.hideWrapper();
        } else {
            this.showWrapper();
        }
    }

    hideWrapper() {
        this.setHeaderHeight(true);
        this.trigger.classList.remove('open');
        this.header.classList.remove('open');
        this.header.classList.remove('active-submenu');
        this.header.classList.remove('active-submenu--second-level');
		this.megaMenuReset(this.megaMenuLinks);
        this.body.classList.remove('overlayed');
        lockScroll.unlock();
    }

    showWrapper() {
        this.setHeaderHeight();
        this.trigger.classList.add('open');
        this.header.classList.add('open');
        if (this.desktopViewport.matches) {
            this.body.classList.add('overlayed');
        }
        lockScroll.lock();
    }

    setHeaderHeight(reset = false) {
        if (this.trigger) {
            const stepsHeight = this.stepMobileWrapper && this.mobileViewport.matches ? this.stepMobileWrapper.clientHeight : 0;
            const alertBarHeight = this.alertBar ? this.alertBar.clientHeight : 0;

            if (reset) {
                this.overlay.removeAttribute('style');
            } else {
                this.overlay.style.height = `calc(${window.innerHeight}px - ${this.headerContainer.clientHeight + stepsHeight + alertBarHeight}px)`;
            }
        }
    }

    megaMenuToggle(e) {
        e.preventDefault();

        if (e.currentTarget.classList.contains('active')) {
            this.hideMegaMenu(e);
        } else {
            this.showMegaMenu(e);
            [...this.mobileTitle].forEach(title => {
                title.textContent = e.currentTarget.textContent;
            });
        }
    }

    megaMenuSecondLevelToggle(e) {
        if(!e.target.href) {
            e.preventDefault()

            if (e.currentTarget.classList.contains('active')) {
                e.currentTarget.classList.remove('active');
                this.setStepsPosition(e.currentTarget, true);
            } else {
                e.currentTarget.classList.add('active');
                this.setStepsPosition(e.currentTarget, true);
            }
        }

    }

    showMegaMenu(e) {
        this.megaMenuReset(this.headerContainer.querySelectorAll('.active'));

        e.currentTarget.classList.add('active');

        if (this.desktopViewport.matches) {
            this.header.classList.add('active-submenu');
            this.setStepsPosition(e.currentTarget)
        } else {
            this.header.classList.add('mega-menu-open');
            this.header.classList.remove('active-steps');
        }
    }

    hideMegaMenu() {
        this.megaMenuReset(this.megaMenuLinks);

        if (this.desktopViewport.matches) {
            this.header.classList.remove('active-submenu');
        } else {
            this.header.classList.remove('mega-menu-open');
        }
    }

    setStepsPosition(target, secondLevel = false) {
        if (this.stepMobileWrapper && !this.mobileViewport.matches) {
            this.stepMobileWrapper.removeAttribute('style');
            const currentWrapper = secondLevel ? target.closest('.mega-menu-wrapper') : target.nextElementSibling;

            if (this.overlay.clientHeight - currentWrapper.clientHeight > 10) {
                this.stepMobileWrapper.style.top = `${currentWrapper.clientHeight}px`;
            } else {
                this.stepMobileWrapper.style.bottom = `0px`;
                currentWrapper.style.paddingBottom = `${this.stepMobileWrapper.clientHeight + 30}px`;
            }
        }
    }

    megaMenuReset(links) {
        [...links].forEach(link => {
            link.classList.remove('active');
        });
    }

    mobileMenuReset() {
        if (this.header.classList.contains('active-submenu--second-level')) {
            this.header.classList.remove('active-submenu--second-level');
            this.megaMenuReset(this.megaMenuLinksSecondLevel);
        } else {
            this.header.classList.remove('active-submenu');
            this.megaMenuReset(this.megaMenuLinks);
        }
    }

    outSideClick(e) {
        if (!this.header.contains(e.target)) {
            if (this.header.classList.contains('open') || this.header.classList.contains('mega-menu-open') || this.header.classList.contains('active-steps')) {

                this.hideWrapper();
                this.hideMegaMenu();

                [...this.stepsButtons].forEach(button => {
                    if (button.classList.contains('active')) {
                        this.hideStepsMenu(button);
                    }
                });
            }
        }
    }

    orientation() {
        if (!this.header) return;

        if (this.header.classList.contains('open')) {
            this.hideWrapper();
        }

        if (this.header.classList.contains('mega-menu-open') || this.header.classList.contains('active-steps')) {
            this.hideMegaMenu();
            [...this.stepsButtons].forEach(button => {
                if (button.classList.contains('active')) {
                    this.hideStepsMenu(button);
                }
            });
        }
    }

    resized() {
        if (!this.header) return;

        if (this.header.classList.contains('open') && this.mobileViewport.matches) {
			this.setHeaderHeight();
        }
    }

    stepsMenuToggle(e) {
        e.preventDefault();
        if (e.currentTarget.classList.contains('active')) {
            this.hideStepsMenu(e.currentTarget);
            this.header.classList.remove('active-steps');
        } else {
            this.showStepsMenu(e.currentTarget);
            this.header.classList.add('active-steps');
            this.hideMegaMenu();
        }
    }

    hideStepsMenu(button) {
        const stepsMenu = button.parentNode.querySelector('.main-header__steps-submenu');

        button.classList.remove('active');
        stepsMenu.classList.remove('active');
        this.header.classList.remove('active-steps');
    }

    showStepsMenu(button) {
        const stepsMenu = button.parentNode.querySelector('.main-header__steps-submenu');

        button.classList.add('active');
        stepsMenu.classList.add('active');

        if (!this.desktopViewport.matches) {
            const alertBarHeight = this.alertBar ? this.alertBar.clientHeight : 0;
            this.stepMenuWrapper.style.height = `calc(${window.innerHeight}px - ${this.headerContainer.clientHeight + alertBarHeight}px)`;
        }
    }

    HeaderVars() {
        const headerObserver = new ResizeObserver(entries => {
            entries.forEach(entry => {
                this.body.style.setProperty('--header-height', `${this.header.offsetHeight}px`);
                this.body.style.setProperty('--header--cta-width', `${this.headerRight.offsetWidth}px`);
            });
        });

        headerObserver.observe(this.header);
    }
}

export default new Header();
