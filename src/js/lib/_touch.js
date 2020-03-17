import Component from './component';
import ScrollBooster from 'scrollbooster';

const classList = {
  root: '.js-body',
  targets: '.js-touch'
};

class Touch extends Component {
  init() {
    this.$.targets.each((i, element) => {
      const $element = $(element);
      const $parent = $element.parent();

      const initWidth = $element.data('initWidth') || $element.width();
      const minWidth = $element.data('minWidth') || 1920;

      this.touch($parent.get(0), $element.get(0), initWidth, minWidth);
    });
  }
  touch(viewport, content, initWidth, minWidth) {
    new ScrollBooster({
      viewport,
      content,
      mode: 'x',
      onClick: (data, e) => {
        if (data.isDragging) {
          e.preventDefault();
        }
      },
      onUpdate: data => {
        if (content.dataset.touchNotavailable) return;

        const $element = $(content);

        const windowWidth = this.$.window.width();
        const suitableScreenSize = minWidth ? windowWidth <= minWidth : false;

        if (initWidth && suitableScreenSize) {
          $element.css({
            'min-width': `${initWidth}px`
          });
        } else {
          $element.css({
            'min-width': '',
            transform: ''
          });
        }

        if (!suitableScreenSize) return;

        const currentWidth = $element.parent().width();

        if (initWidth && currentWidth <= initWidth) {
          $element.css({
            transform: `translateX(${-data.position.x}px)`
          });
        } else {
          $element.css({
            transform: ''
          });
        }
      }
    });
  }
}

export default Component.mount(Touch, {
  name: 'Touch',
  singleton: true,
  state: {
    $current: null
  },
  classList
});
