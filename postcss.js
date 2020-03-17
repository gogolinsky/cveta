const postcss = require('postcss');
const fs = require('fs');

const { isProduction, path } = require('./config');
const { dest, build, root } = path;
const file = isProduction ? `${build}/css/style.css` : `${dest}/css/style.css`;

const plugin = {
  autoprefixer: require('autoprefixer'),
  objectFit: require('postcss-object-fit-images'),
  imageInliner: require('postcss-image-inliner'),
  cssnano: require('cssnano')
};

fs.readFile(file, (err, css) => {
  postcss([
    plugin.autoprefixer(),
    plugin.objectFit(),
    plugin.imageInliner({ assetPaths: [`${root}`] }),
    plugin.cssnano({ preset: 'default' })
  ])
    .process(css, {
      from: file,
      to: file
    })
    .then(result => {
      fs.writeFile(file, result.css, () => true);
    });
});
