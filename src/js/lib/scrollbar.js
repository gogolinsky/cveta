import Component from "./component";
import "minibarjs";

export default class Scrollbar extends Component {
  init() {
    this.instance = Scrollbar.init(this.$.root.get(0));
  }
  reInit() {
    this.destroy();
    this.init();
  }
  destroy() {
    Scrollbar.destroy(this.instance);
  }
  static init(element) {
    // @ts-ignore
    return new MiniBar(element);
  }
  static destroy(instance) {
    instance.destroy();
  }
}

Component.mount(Scrollbar, {
  name: "Scrollbar",
  classList: {
    root: ".js-scrollbar"
  }
});
