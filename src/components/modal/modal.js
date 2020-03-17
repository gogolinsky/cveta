/**
 * modal
 */

import Component from "../../js/lib/component";
import Page from "../page/page";

import $ from "jquery";
import VanillaModal from "vanilla-modal";

const focusableList = "a, button, input, textarea, select, textarea";

const classList = {
  root: ".js-modal",
  template: ".js-modal-template",
  inner: ".js-modal-inner",
  title: ".js-modal-title",
  header: ".js-modal-header",
  content: ".js-modal-content",
  default: ".js-modal-default"
};

class Modal extends Component {
  init() {
    this.modal = new VanillaModal({
      modal: classList.template,
      modalInner: classList.inner,
      modalContent: classList.content,
      loadClass: "modal-init",
      onBeforeOpen: () => {
        Page.bodyOverflowEnable();
        this.onTransition().then(() => {
          this.setFocus();
        });
      },
      onBeforeClose: () => {
        this.onTransition().then(() => {
          Page.bodyOverflowDisable();
          this.unsetFocus();
        });
      }
    });

    this.setState({ init: true });
  }
  events() {
    this.$.template.children().on("transitionend", e => {
      e.stopPropagation();
    });
    this.$.document.on("click.modal", "[data-modal-close]", () => this.close());
    this.$.document.on("click.modal", "[data-modal]", e => this.handler(e));
  }
  handler(e) {
    e.preventDefault();

    const $target = $(e.currentTarget);
    const data = $target.data("modal");

    if (name.indexOf("/") === -1) {
      const modalId = `#modal-${data}`;
      const title = $(modalId).data("title") || null;
      this.setTitle(title);
      this.open(modalId);
    } else {
      this.loadAndOpen({ $target, url: data });
    }
  }
  loadAndOpen({ $target, url, data = {}, content = null }) {
    const timeout = setTimeout(() => {
      if ($target) {
        $target.addClass("is-loading");
      }
    }, 800);

    this.load({ url, data, content })
      .then(({ title, html }) => {
        this.setContent(html);
        this.setTitle(title);
        this.open("#modal-default");

        this.onTransition().then(() => {
          clearTimeout(timeout);
          if ($target) {
            $target.removeClass("is-loading");
          }
        });
      })
      .catch(err => {
        console.error(err);
        clearTimeout(timeout);
        if ($target) {
          $target.removeClass("is-loading");
        }
      });
  }
  load({ url, data, content }) {
    return new Promise((resolve, reject) => {
      if (content) {
        resolve(content);
      } else {
        return $.ajax(url, { data })
          .then(({ title, html }) => {
            resolve({ title, html });
          })
          .fail(err => reject(err));
      }
    });
  }
  setContent(content) {
    if (this.$.default.length) {
      this.$.default.html(content);
    }
  }
  setTitle(title) {
    if (title) {
      this.$.title.text(title);
      this.$.header.show();
    } else {
      this.$.header.hide();
    }
  }
  open(id) {
    if (this.isOpen()) {
      this.close().then(() => {
        this.modal.open(id);
      });
    } else {
      this.modal.open(id);
    }
  }
  close() {
    if (!this.isOpen()) return Promise.resolve();

    return this.nextTick().then(() => {
      this.modal.close();
      return this.onTransition();
    });
  }
  onTransition() {
    return new Promise(resolve => {
      this.$.template.one("transitionend", () => {
        resolve();
      });
    });
  }
  isOpen() {
    return this.modal.isOpen;
  }
  setFocus() {
    const $focusableInModal = this.$.template.find(focusableList);

    $(focusableList).attr("tabindex", -1);
    $focusableInModal.removeAttr("tabindex");
  }
  unsetFocus() {
    $(focusableList).removeAttr("tabindex");
  }
  destroy() {
    if (!this.state.init) return;

    this.modal.destroy();

    this.$.document.off("click.modal");
    this.$.document.off("click.modal");

    delete this.modal;
    delete this.state;
  }
}

export default Component.mount(Modal, {
  name: "Modal",
  classList,
  singleton: true,
  state: {
    init: false
  }
});
