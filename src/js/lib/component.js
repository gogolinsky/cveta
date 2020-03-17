import $ from "jquery";

Array.prototype._one = function() {
  return this[0] || undefined;
};

export const subscribers = {};

export default class Component {
  constructor(element, options) {
    this.id = element.componentId;
    this.selector = options.classList.root || "";
    this.name = options.name || this.selector.substr(4);
    this.state = Object.assign({}, options.state) || {};
    this.classList = options.classList;

    if ("dependencies" in options && options.dependencies.length) {
      options.dependencies.forEach(dependency => {
        this[dependency.name] = dependency;
      });
    }

    this.$ = {
      window: $(window),
      document: $(document),
      body: $(".js-body"),
      page: $(".js-page"),
      root: $(element)
    };

    this.elements();

    if (this.$.root.length) {
      this.$.document.ready(() => {
        if (this.init) this.init();
        if (this.events) this.events();
        if (this.mounted) this.mounted();
      });
    }
  }
  elements() {
    for (let element in this.classList) {
      if (element !== "root") {
        this.$[element] = this.$.root.find(this.classList[element]);
      }
    }
  }
  subscribe(name, fn) {
    if (!subscribers[name]) {
      subscribers[name] = [];
    }

    subscribers[name].push(fn);
  }
  publish(name, data = {}) {
    if (subscribers[name]) {
      subscribers[name].forEach(subscriber => {
        subscriber(data);
      });
    }
  }
  nextTick(time = 0) {
    return new Promise(resolve => {
      setTimeout(() => {
        resolve();
      }, time);
    });
  }
  trottle(fn, delay) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(fn.bind(this, ...args), delay);
    };
  }
  parents(name) {
    return this.traversal("up", name);
  }
  childs(name) {
    return this.traversal("down", name);
  }
  traversal(direction, name) {
    const directions = {
      up: "parents",
      down: "find"
    };

    const _components = Array.from(
      this.$.root[directions[direction]]('[class*="js-"]')
    )
      .filter(node => Boolean(node.component))
      .map(item => item.component);

    return name
      ? _components.filter(component => (name ? component.name === name : true))
      : _components;
  }
  setState(state) {
    this.state = Object.assign({}, this.state, state);
  }
  static mount(Constructor, options) {
    const $elements = $(options.classList.root);

    if (!Boolean($elements.length)) return {};

    const init = element => {
      const id = Math.random()
        .toString(16)
        .slice(2);

      element.selector = options.classList.root;
      element.componentId = id;

      try {
        return new Constructor(element, options);
      } catch (error) {
        return console.error(error), {};
      }
    };

    if (options.singleton) {
      const element = $elements.get(0);
      const component = init(element);

      element.component = component;

      return component;
    } else {
      $elements.map((i, element) => {
        element.component = init(element);
      });
    }
  }
}
