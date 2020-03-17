export default name => {
  const $element = $(`.js-${name}`);

  if ($element.length) {
    $.getScript(`/js/${name}.js`);
  }
};
