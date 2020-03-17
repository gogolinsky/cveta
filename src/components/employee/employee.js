/**
 * Employee
 */

import Component from "../../js/lib/component";

const classList = {
  root: ".js-employee"
};

class Employee extends Component {
  init() {
    $(".js-employee-button").on("click", function() {
      let src = $(this).attr("data-scr");
      $.ajax({
        url: src,
        success: function() {
          $(".js-modal-content")
            .append()
            .load(src);
        }
      });
    });
  }
}

export default Component.mount(Employee, {
  name: "Employee",
  classList,
  state: {}
});
