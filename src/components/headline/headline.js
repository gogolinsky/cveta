/**
 * colorPicker
 */

import Component from "../../js/lib/component";

const classList = {
  root: ".js-headline",
  picker: ".js-headline-picker"
};

class Headline extends Component {
  events() {
    this.subscribe("colorPicker.selected", ({ color }) => {
      this.setPickerColor(color);
    });
  }
  setPickerColor(color) {
    this.$.picker.css("background-color", color);
  }
}

export default Component.mount(Headline, {
  name: "Headline",
  classList,
  state: {}
});
