/**
 * Select
 */

import SlimSelect from "slim-select";
import $ from "jquery";
import Component from "../../js/lib/component";
import Scrollbar from "../../js/lib/scrollbar";

export default class Select extends Component {
  init() {
    this.placeholder = this.$.root.data("placeholder") || "";
    this.valueWithPlaceholder =
      this.$.root.data("valueWithPlaceholder") || false;

    this.select = new SlimSelect({
      select: this.$.root.get(0),
      placeholder: this.placeholder,
      showSearch: false,
      beforeOnChange: () => {
        const { singleSelected } = this.select.slim;
        const $placeholder = $(singleSelected.placeholder);

        if (this.valueWithPlaceholder) {
          $placeholder.css("opacity", 0);
        }
      },
      onChange: info => {
        if (this.scrollbar) {
          this.scrollbar = null;
        }

        if (this.valueWithPlaceholder) {
          setTimeout(() => {
            const { singleSelected } = this.select.slim;
            const $placeholder = $(singleSelected.placeholder);

            $placeholder.html(`<i>${this.placeholder}</i>: ${info.text}`);
            $placeholder.css("opacity", 1);
          }, 0);
        }
      },
      beforeOpen: () => {
        if (!this.scrollbar) {
          const $list = $(this.select.slim.list);
          const $childs = $list.children();
          const $clone = $list.clone();

          $clone.html($childs);
          $list.replaceWith($clone);

          this.select.slim.list = $clone.get(0);
          this.scrollbar = Scrollbar.init(this.select.slim.list);

          setTimeout(() => {
            this.scrollbar.update();
          }, 200);
        }
      },
      afterClose: () => {
        if (this.scrollbar) {
          Scrollbar.destroy(this.scrollbar);
          this.scrollbar = null;
        }
      }
    });

    this.$.root.addClass("is-inited");
  }
  reset() {
    // this.$.root.css('opacity', 0);
    this.select.destroy();
    this.$.root
      .find("option")
      .first()
      .prop("selected", true);
    this.init();
    // this.$.root.css('opacity', 1);
  }
}

Component.mount(Select, {
  name: "Select",
  classList: { root: ".js-select" }
});
