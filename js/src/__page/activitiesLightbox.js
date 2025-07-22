import lockScroll from '../__utils/lockScroll';
const $ = jQuery.noConflict();

class ActivitiesLightbox {
    constructor() {
        this.lightbox = document.querySelectorAll('[data-lightbox]');
        this.lightboxTrigger = document.querySelectorAll('[data-lightbox-trigger]');
        this.lightboxTriggerClose = document.querySelectorAll('[data-lightbox-close]');
    }

    init() {
        if (!this.lightbox) return;

        [...this.lightboxTrigger].forEach(trigger => {
            trigger.addEventListener('click', (e) => this.openLightbox(e));
        });

        [...this.lightboxTriggerClose].forEach(trigger => {
            trigger.addEventListener('click', (e) => this.closeLightbox(e));
        });

        window.addEventListener('keydown', (e) => this.keyPressDispatcher(e));
    }

    openLightbox(e) {
        e.preventDefault();
        const slideNum = parseInt(e.currentTarget.getAttribute('data-item').slice(1), 10);
        const lightboxWrapper = e.currentTarget.closest('[data-lightbox-wrapper]').querySelector('[data-lightbox]');

        lightboxWrapper.classList.add('active');
        $(lightboxWrapper).find('[data-lightbox-slider]').slick('slickGoTo', slideNum, true);

        lockScroll.lock();
    }

    closeLightbox(e) {
        e.currentTarget.parentNode.classList.remove('active');
        lockScroll.unlock();
    }

    keyPressDispatcher(e) {
        if (e.keyCode == 27) {
            [...this.lightbox].forEach(item => {
                item.classList.remove('active');
            });
        }

        lockScroll.unlock();
    }
}

export default new ActivitiesLightbox();