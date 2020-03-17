import 'intersection-observer';

const $target = $('[data-reveal]');
const observer = new IntersectionObserver(
  entries => {
    entries.forEach(({ isIntersecting, target }) => {
      if (isIntersecting) {
        $(target).addClass('is-visible');
      }
    });
  },
  {
    root: null,
    rootMargin: '15%',
    threshold: 0.5
  }
);

$target.each((i, leaf) => {
  observer.observe(leaf);
});
