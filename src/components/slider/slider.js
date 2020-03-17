import Component from '../../js/lib/component';

import Swiper from 'swiper';
import $ from 'jquery';


const classList = {
  root: '.js-slider',
  wrapper: '.js-slider-wrapper',
  image: '.js-slider-image',
  container: '.js-slider-container',
};


export default class Slider extends Component {
  init() {
    this.slider();
  };
  
  slider() {
    this._swiper = new Swiper(classList.container, {
      speed: 700,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.image.substr(1),
      slidesPerView: 1,
      simulateTouch: false,
      watchOverflow: true,
      on: {
        init: () => {
          this.$.root.addClass('is-inited');
        }
      },
      navigation: {
        nextEl: '.slider-button-next',
        prevEl: '.slider-button-prev',
      },
    });
  }
}

Component.mount(Slider, {
    name: 'Slider',
    state: {},
    classList
});