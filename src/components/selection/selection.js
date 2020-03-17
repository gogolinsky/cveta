import Component from "../../js/lib/component";
import Scrollbar from "../../js/lib/scrollbar";
import $ from "jquery";
import { log } from "util";

const classList = {
  root: ".js-selection",
  drop: ".js-selection-drop"
};

export default class Selection extends Component {
  init() {
    $(".js-selection").click(e => {
      $(".js-selection-drop").fadeToggle(150);
    });

    $(".js-selection-button").click(e => {
      $(".js-selection-drop").fadeToggle(100);
    });

    $(".js-filter-form").on("change", function(e) {
      let $form = $(this).closest("form");
      $.ajax({
        url: $form.attr("action"),
        data: $form.serialize(),
        beforeSend: function() {
          $(".js-products-loader").css("display", "block");
          $(".js-products").css("display", "none");
        },
        success: function({ html }) {
          $(".js-products").html(html);
          $(".js-products-loader").css("display", "none");
          $(".js-products").css("display", "block");
        }
      });
    });

    $(".js-selection-reset").click(e => {
      $(".js-filter-form").trigger("change");
    });
  }
}

Component.mount(Selection, {
  name: "Selection",
  state: {},
  classList
});
