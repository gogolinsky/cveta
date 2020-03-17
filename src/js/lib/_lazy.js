import 'intersection-observer';
import $ from 'jquery';

export default class Lazy {
  static init(animate = true) {
    const images = Array.from(document.querySelectorAll(Lazy.selector));

    const observer = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach(({ isIntersecting, target }) => {
          if (isIntersecting) {
            if (target.classList.contains('is-loaded')) return;

            const src = target.dataset.lazy;

            Lazy.loadImage(src, target).then(() => {
              const $target = $(target);

              if (!animate) {
                $target.css('transition', 'none');
              }

              $target
                .addClass('is-loaded')
                .attr('src', src)
                .css('opacity', 1)
                .one('transitionend', () => {
                  $target.removeAttr('data-lazy');
                  $target.removeAttr('style');
                });
            });
          }
        });
      },
      {
        root: null,
        rootMargin: '15%',
        threshold: 0.5
      }
    );

    images.forEach(image => {
      observer.observe(image);
    });
  }
  static loadImage(src, target) {
    return new Promise(resolve => {
      target.src = src;
      target.onload = () => {
        resolve();
      };
    });
  }
  static get selector() {
    return '[data-lazy]';
  }
}

Lazy.init();
