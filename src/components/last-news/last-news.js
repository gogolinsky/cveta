import Component from '../../js/lib/component';

import Swiper from 'swiper';
import $ from 'jquery';

const classList = {
  root: '.js-last',
  wrapper: '.js-last-wrapper',
  item: '.js-last-item',
  container: '.js-last-container',
};


export default class Last extends Component {
  init() {
    this.roll();
  };
  
  roll() {
    this._swiper = new Swiper(classList.container, {
      speed: 700,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.item.substr(1),
      centerInsufficientSlides: true,
      grabCursor: true,
      watchOverflow: true,
      width: 370,
      spaceBetween: 30,
      on: {
        init: () => {
          this.$.root.addClass('is-inited');
        }
      },
      navigation: {
        nextEl: '.last-button-next',
        prevEl: '.last-button-prev',
      },
    });
  }
}

Component.mount(Last, {
    name: 'Last',
    state: {},
    classList
});