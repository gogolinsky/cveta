/**
 * colorPicker
 */

import Component from "../../js/lib/component";
import chroma from "chroma-js";

const classList = {
  root: ".js-color-picker",
  list: ".js-color-picker-list",
  item: ".js-color-picker-item",
  subitem: ".js-picker-subitem"
};

const colorItemTemplate = color =>
  `<li class="color-picker__item js-picker-subitem" style="background-color:${color};" data-color="${color}" data-modal-close></li>`;

export default class ColorPicker extends Component {
  init() {
    this.nextTick().then(() => {
      this.setColor(this.getSaveColor());
    });
  }
  events() {
    this.$.document.on("click", classList.item, e => {
      const color = this.clickHandler(e);
      const colors = this.generateColors(color);
      const html = this.generateColorListHTML(colors);

      this.renderList(html);
      this.showList();
    });

    this.$.document.on("click", classList.subitem, e => {
      this.clickHandler(e);
    });
  }
  clickHandler(e) {
    const $target = $(e.currentTarget);
    const color = this.getColor($target);

    this.toggleItem($target);
    this.saveColor(color);
    this.setColor(color);

    return color;
  }
  getSaveColor() {
    return localStorage.getItem("myColor");
  }
  saveColor(color) {
    localStorage.setItem("myColor", color);
  }
  toggleItem($current) {
    this.$.item
      .removeClass("is-select")
      .filter($current)
      .addClass("is-select");
  }
  renderList(html) {
    this.$.list.html(html);
  }
  showList() {
    this.$.list.addClass("is-visible");
  }
  getColor($target) {
    return $target.data("color");
  }
  setColor(color) {
    this.publish("colorPicker.selected", { color });
  }
  generateColors(color) {
    const brightenColors = [];
    const darkenColors = [];

    for (let i = 0; i < 6; i++) {
      brightenColors.push(
        chroma(color)
          .brighten(i / 5)
          .hex()
      );

      darkenColors.push(
        chroma(color)
          .darken(i / 5)
          .hex()
      );
    }

    return [...brightenColors.reverse().slice(1), color, ...darkenColors];
  }
  generateColorListHTML(colors) {
    return colors.map(color => colorItemTemplate(color)).join("");
  }
}

Component.mount(ColorPicker, {
  name: "ColorPicker",
  classList,
  state: {}
});
