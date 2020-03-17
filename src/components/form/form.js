import Component from "../../js/lib/component";
import IMask from "imask";

const classList = {
  root: ".input-phone"
};

export default class Form extends Component {
  init() {
    var elements = document.getElementsByClassName("input-phone");

    for (var i = 0; i < elements.length; i++) {
      new IMask(elements[i], {
        mask: "+{7} (000) 000-00-00"
      });
    }
  }
}

Component.mount(Form, {
  name: "Form",
  state: {},
  classList
});
