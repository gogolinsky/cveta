/**
 * productCard
 */

import Component from "../../js/lib/component";

const classList = {
  root: ".js-product-card",
  picker: ".js-product-card-picker",
  volume: ".js-product-volume",
  need: ".js-product-need",
  list: ".js-list-product"
};
class ProductCard extends Component {
  events() {
    this.$.volume.on("change", function() {
      let consumption = $(this).attr("consumption");
      let json = JSON.parse($(this).attr("volume"));
      let volumes = Object.keys(json).map(current => parseInt(current));
      let volume = Math.ceil($(this).val() / consumption);
      let res = [];

      $(".js-product-need").html(volume + "<i> л/2 слоя</i>");

      while (volume > 0) {
        let number = volumes
          .sort((a, b) => a - b)
          .filter((item, index) => item <= volume || index == 0)
          .pop();

        let product = json[number];
        let obj = { name: product.name, price: product.price, quantity: 1 };

        if (res.filter(item => item.name == product.name).length == 0) {
          res.push(obj);
        } else {
          res.map(item => {
            if (item.name == obj.name) {
              item.quantity += obj.quantity;
              item.price += obj.price;
            }
          });
        }
        volume -= number;
      }

      let rows = res
        .map(item => {
          return `<div class="list__row">
        <div class="list__volume">
        <p class="list__tin">${item.name}</p>
        <p class="list__cost">${item.price
          .toString()
          .replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g, "$1" + " ")} ₽</p>
        </div>
        <p class="list__quantity">${item.quantity} шт</p>
        </div>`;
        })
        .join("");

      rows = rows || "<div class='list__row'>Укажите площадь</div>";

      $(".js-list-product").html(rows);
    });

    this.subscribe("colorPicker.selected", ({ color }) => {
      this.setPickerColor(color);
    });
  }
  setPickerColor(color) {
    this.$.picker.css("background-color", color);
  }
}

export default Component.mount(ProductCard, {
  name: "ProductCard",
  classList,
  state: {}
});
