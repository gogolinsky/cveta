/**
 * scroll
 */

import Component from './component';
import anime from 'animejs';
import $ from 'jquery';

export default class Scroll extends Component {
  init() {
    this.animating = false;
    this.rellaxDisabled = true;
  }
  events() {
    this.$.anchors.on('click', e => this.handler(e));
  }
  handler(e) {
    e.preventDefault();

    if (this.animating) return false;

    const $current = $(e.currentTarget);
    const $target = $($current.attr('href'));

    this.scrollTo($target);
  }

  scrollTo($target, done) {
    if (!$target.length) return;

    this.animating = true;

    const offset = $target.offset().top;
    const targets = $('html, body').get();
    const duration = 800;

    anime({
      targets,
      scrollTop: offset,
      duration,
      easing: 'easeInOutCubic',
      complete: () => {
        if (done) done();
        this.animating = false;
      }
    });
  }
}

Component.mount(Scroll, {
  name: 'Scroll',
  classList: {
    root: '.js-body',
    anchors: '[data-scroll-to]'
  }
});
