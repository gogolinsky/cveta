const gulp = require('gulp');
const { task, series, parallel, src, dest } = gulp;

const tinypng = require('gulp-tinypng');
const imagemin = require('gulp-imagemin');

const svgmin = require('gulp-svgmin');
const svgstore = require('gulp-svgstore');
const cheerio = require('gulp-cheerio');
const rename = require('gulp-rename');

const config = {
  images: 'frontend/img/',
  icons: 'frontend/icons/',
  dest: 'dist/img/'
};

task(
  'compress',
  parallel(
    function tinypngHandler() {
      return src(`${config.images}*.{jpg,jpeg,png}`)
        .pipe(tinypng('6Ili_B2bO9-zM6Z18V-Q8CsT1UQes5nX'))
        .pipe(dest(config.dest));
    },
    function imageHandler() {
      return src([`${config.images}*.{gif,svg}`, `!${config.images}sprite.svg`])
        .pipe(
          imagemin({
            progressive: true,
            svgoPlugins: [{ removeViewBox: false, removeTitle: true }]
          })
        )
        .pipe(dest(config.dest));
    }
  )
);

task(
  'sprite',
  series(function spriteHandler() {
    return src(`${config.icons}*.svg`)
      .pipe(svgstore())
      .pipe(
        cheerio({
          run: $ => {
            $('symbol *').removeAttr('class');
          },
          parserOptions: {
            xmlMode: true
          }
        })
      )
      .pipe(rename('sprite.svg'))
      .pipe(dest(`${config.images}`));
  })
);
