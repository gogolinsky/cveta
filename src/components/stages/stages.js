import Component from "../../js/lib/component";

import Swiper from "swiper";
import $ from "jquery";
import anime from "animejs";

const classList = {
  root: ".js-stages",
  wrapper: ".js-stages-wrapper",
  item: ".js-stages-item",
  container: ".js-stages-container",
  img: ".js-stages-img",
  progress: ".js-stages-progress"
};

export default class Stages extends Component {
  init() {
    this.stage();

    $(".stages__stage0").click(e => {
      this.$.progress.css("stroke-dashoffset", "1300");
    });
    $(".stages__stage1").click(e => {
      this.$.progress.css("stroke-dashoffset", "840");
    });
    $(".stages__stage2").click(e => {
      this.$.progress.css("stroke-dashoffset", "380");
    });
    $(".stages__stage3").click(e => {
      this.$.progress.css("stroke-dashoffset", "0");
    });

    this._swiper.on("slideChange", () => {
      if ($(".stages__stage0").hasClass("swiper-pagination-bullet-active")) {
        this.$.progress.css("stroke-dashoffset", "1300");
      } else if (
        $(".stages__stage1").hasClass("swiper-pagination-bullet-active")
      ) {
        this.$.progress.css("stroke-dashoffset", "840");
      } else if (
        $(".stages__stage2").hasClass("swiper-pagination-bullet-active")
      ) {
        this.$.progress.css("stroke-dashoffset", "460");
      } else if (
        $(".stages__stage3").hasClass("swiper-pagination-bullet-active")
      ) {
        this.$.progress.css("stroke-dashoffset", "0");
      }
    });
  }

  stage() {
    this._swiper = new Swiper(classList.container, {
      speed: 1000,
      width: 700,
      wrapperClass: classList.wrapper.substr(1),
      slideClass: classList.item.substr(1),
      slidesPerView: 1,
      spaceBetween: 40,
      simulateTouch: false,
      loop: true,
      effect: "fade",
      on: {
        init: () => {
          this.$.root.addClass("is-inited");
        },
        slideChange: () => {
          $(".swiper-slide-active .js-stages-img").css("opacity", "0");
          $(".swiper-slide-active .stages__description")
            .addClass("is-fade")
            .css("opacity", "0");
          // this.$.progress.css("stroke-dashoffset", `${stroke}`);
        },
        slideChangeTransitionStart: () => {
          $(".swiper-slide-active .js-stages-img").css("opacity", "1");
          $(".swiper-slide-active .stages__description")
            .removeClass("is-fade")
            .css("opacity", "1");
        }
      },

      pagination: {
        el: ".stages__pagination",
        renderBullet: function(index, className) {
          return (
            '<span class="stages__stage' +
            index +
            " " +
            className +
            '">' +
            "<p>0" +
            (index + 1) +
            "</p> </span>"
          );
        },
        clickable: true
      },
      autoplay: {
        delay: 5000
      }
    });
  }
}

Component.mount(Stages, {
  name: "Stages",
  state: {},
  classList
});
