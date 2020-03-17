import Component from '../../js/lib/component';

class Page extends Component {
  init() {
    this.breakpoint = {
      lg: 1599,
      xl: 1439,
      l: 1179,
      md: 959,
      m: 767,
      s: 559,
      xs: 320
    };

    this.mq = {
      desktop: matchMedia('(min-width: 1365px)'),
      tablet: matchMedia('(max-width: 1365px)'),
      mobile: matchMedia('(max-width: 560px)')
    };
  }
  events() {
    this.$.window.on('keydown', e => {
      if (e.keyCode === 27) {
        this.publish('page:esc');
      }
    });
  }
  bodyOverflowEnable() {
    this.$.body.css('paddingRight', this.getScrollbarWidth());
    this.$.body.addClass('is-overflow');
  }
  bodyOverflowDisable() {
    this.$.body.removeAttr('style');
    this.$.body.removeClass('is-overflow');
  }
  getScrollbarWidth() {
    return window.innerWidth - this.$.document.width();
  }
}

export default Component.mount(Page, {
  name: 'Page',
  classList: { root: '.js-page' },
  singleton: true,
  state: {}
});
