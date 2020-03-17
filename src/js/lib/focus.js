/**
 * @FocusController
 */

import $ from 'jquery';

const FocusController = {
  $document: $(document),
  focusElements: 'a, button, input, select, textarea, fieldset',
  init() {
    this.$document.on('click', e => {
      const $target = $(e.currentTarget);

      if (!$target.is(this.focusElements)) {
        this.$elements.removeClass('is-focused');
      }
    });

    this.$document.on('focus', (e, data) => {
      if (data) {
        this.$elements.removeClass('is-focused');
        data.$trigger.addClass('is-focused');
      }
    });

    this.$document.on('keydown', e => {
      if (e.keyCode === 9) {
        this.$elements.removeClass('is-focused');
        this.$elements.one('focus', e => {
          const $target = $(e.currentTarget);
          $target.addClass('is-focused');
        });

        this.$elements.one('blur', e => {
          const $target = $(e.currentTarget);
          if ($target.is('.is-focused')) {
            $target.removeClass('is-focused');
          }
        });
      }
    });

    this.$document.on('keyup', e => {
      if (e.keyCode === 9) {
        this.$elements.off('focus');
        this.$elements.off('blur');
      }
    });
  },
  get $elements() {
    return $(this.focusElements);
  }
};

FocusController.init();

export default FocusController;
