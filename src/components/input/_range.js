/**
 * Range
 */

import $ from "jquery";
import "jquery-ui";
import "jquery-ui/ui/widgets/mouse";
import "jquery-ui/ui/widgets/slider";
import { priceFormat } from "../../js/Store";
import Component from "../../js/lib/component";
const classList = {
  root: ".js-range",
  slider: ".js-range-slider",
  from: ".js-range-from",
  to: ".js-range-to"
};

export default class Range extends Component {
  init() {
    this.param = {
      MIN: Number(this.$.slider.data("min")) || 0,
      MAX: Number(this.$.slider.data("max")) || 1000,
      STEP: Number(this.$.slider.data("step")) || 5,
      START: Number(this.$.slider.data("from")) || 100,
      END: Number(this.$.slider.data("to")) || 800
    };

    this.DEFAULT = [this.param.START, this.param.END];

    this.setFieldsAttr();
    this.slider();
  }
  events() {
    this.$.from.on("change", { type: "FROM" }, this.handler.bind(this));
    this.$.to.on("change", { type: "TO" }, this.handler.bind(this));
  }
  setFieldsAttr() {
    this.$.from.attr({ min: this.param.MIN, max: this.param.MAX });
    this.$.to.attr({ min: this.param.MIN, max: this.param.MAX });
  }
  slider() {
    this.$.slider.slider({
      range: true,
      min: this.param.MIN,
      max: this.param.MAX,
      step: this.param.STEP,
      values: this.DEFAULT,
      slide: (e, ui) => {
        this.param.START = ui.values[0];
        this.param.END = ui.values[1];
        this.update();
      },
      stop: () => {
        this.$.from.change();
      }
    });
  }
  update() {
    this.$.slider.slider({
      values: [this.param.START, this.param.END]
    });

    this.$.from.val(priceFormat(this.param.START));
    this.$.to.val(priceFormat(this.param.END));
  }
  handler(e) {
    const $target = $(e.target);
    const type = e.data.type;

    this.setValue(type);
    this.validate(type, $target);
    this.update();
  }
  validate(type, $target) {
    const MIN = Number(this.param.MIN);
    const MAX = Number(this.param.MAX);
    const VALUE = parseInt($target.val());

    const condition = value => {
      return !Number.isInteger(value) || value < MIN || value > MAX;
    };

    this.getMethod(
      {
        FROM: () =>
          (this.param.START = condition(VALUE)
            ? this.DEFAULT[0]
            : this.param.START),
        TO: () =>
          (this.param.END = condition(VALUE) ? this.DEFAULT[1] : this.param.END)
      },
      type
    ).call(this);

    this.update();
  }
  setValue(type) {
    this.getMethod(
      {
        FROM: () => (this.param.START = parseInt(this.$.from.val())),
        TO: () => (this.param.END = parseInt(this.$.to.val()))
      },
      type
    ).call(this);
  }
  getMethod(map, type) {
    return map[type];
  }
  reset() {
    const [START, END] = this.DEFAULT;

    this.param.START = START;
    this.param.END = END;
    this.update();
  }
}

Component.mount(Range, {
  name: "Range",
  classList
});
