/**
 * roll
 */

import Component from '../../js/lib/component';
import Swiper from 'swiper';
import $ from 'jquery';

const classList = {
  root: '.js-product-slider',
  item: '.js-product-slider-item',
  wrapper: '.js-product-slider-wrapper',
  image: '.js-product-slider-image',
  container: '.js-product-slider-container',
  thumbnails: '.js-product-slider-thumbnails'
};

export default class ProductSlider extends Component {
  init() {
    this.slider();
  }
  events() {
    this._swiper.on('slideChange', () => {
      this.setCurrentItem();
    });

    this.$.document.on('click', classList.item, e => {
      const $target = $(e.target);
      const $current = $target.is(classList.item)
        ? $target
        : $target.closest(this.$.item);
      const $items = this.$.item;
      const $item = $items.filter($current);
      const index = $items.index($item);
      this._swiper.slideTo(index, 500);
    });
  }
  slider() {
    this._swiper = new Swiper(classList.container, {
      speed: 500,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.image.substr(1),
      spaceBetween: 50,
      on: {
        init: () => {
          this.$.root.addClass('is-inited');
        }
      },
      navigation: {
        nextEl: '.product-slider-next',
        prevEl: '.product-slider-prev',
      },
    });

    this.roll();
    this.setCurrentItem();
  }
  roll() {
    this._roll = new Swiper(classList.thumbnails, {
      speed: 500,
      spaceBetween: 17,
      slidesPerView: 4,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.item.substr(1),
      dragSize: 68,
      
    });
  }
  setCurrentItem() {
    const index = this._swiper.realIndex;
    const $items = this.$.item.not('.is-video');
    const $item = $items.eq(index);
    $items.removeClass('is-active');
    $item.addClass('is-active');
    this._roll.slideTo(index, 500);
  }
}

Component.mount(ProductSlider, {
  name: 'ProductSlider',
  classList,
  state: {}
});
