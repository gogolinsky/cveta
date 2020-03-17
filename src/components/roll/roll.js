import Component from '../../js/lib/component';

import Swiper from 'swiper';
import $ from 'jquery';

const classList = {
  root: '.js-roll',
  wrapper: '.js-roll-wrapper',
  item: '.js-roll-item',
  container: '.js-roll-container',
};


export default class Roll extends Component {
  init() {
    this.roll();
  };
  
  roll() {
    this._swiper = new Swiper(classList.container, {
      speed: 700,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.item.substr(1),
      slidesPerView: 2,
      grabCursor: true,
      watchOverflow: true,
      width: 1170,
      spaceBetween: 30,
      on: {
        init: () => {
          this.$.root.addClass('is-inited');
        }
      },
      navigation: {
        nextEl: '.roll-button-next',
        prevEl: '.roll-button-prev',
      },
    });
  }
}

Component.mount(Roll, {
    name: 'Roll',
    state: {},
    classList
});