// ===================================================
// Settin'
// ===================================================

var gulp            = require('gulp'),
    gulpLoadPlugins = require('gulp-load-plugins'),
    $               = gulpLoadPlugins({
                        rename: {
                          'gulp-minify-css'  : 'mincss',
                          'gulp-minify-html' : 'minhtml',
                          'gulp-gh-pages'    : 'ghPages',
                          'gulp-foreach'     : 'foreach',
                          'gulp-mocha'       : 'mocha',
                          'gulp-if'          : 'if'
                        }
                      }),
    assemble        = require('assemble'),
    postcss         = require('gulp-postcss'),
    mqpacker        = require('css-mqpacker'),
    autoprefixer    = require('autoprefixer'),
    del             = require('del'),
    merge           = require('merge-stream'),
    basename        = require('path').basename,
    extname         = require('path').extname;
    concat          = require('gulp-concat');

$.exec   = require('child_process').exec;
$.fs     = require('fs');


// ===================================================
// Configin'
// ===================================================

var env_flag = false;


var glob = {
  css: 'css/*.css',
  sass: 'sass/**/*.scss',
  js: 'js/**/*.js'
};


// ===================================================
// Stylin'
// ===================================================

gulp.task('sass', function() {
  var processors = [
    autoprefixer({browsers: ['last 2 versions']}),
    mqpacker({sort: true})
  ];

  var stream = gulp.src(glob.sass)
    .pipe($.sass())
    .pipe(postcss(processors))
    .pipe(gulp.dest('css'));

  return stream;
});

// ===================================================
// Concat JS
// ===================================================

// get All Drupal JS and make available for styleguide
gulp.task('script', function() {
  return merge(
    gulp.src(['../../../libraries/modernizr/modernizr.min.js', '../../../libraries/jquery/jquery-1.11.1.min.js', '../../../libraries/jquery.once/jquery.once.js', '../../../../../misc/drupal.js', 'js/contrib/drupal.vertical-tabs.js', '../../../libraries/jquery.selectbox/jquery.selectbox.js', '../../../modules/contrib/selectbox/js/selectbox.js'])
      .pipe(concat('contrib.js'))
      .pipe(gulp.dest('js')),

    gulp.src(['js/custom/*.js'])
      .pipe(concat('theme.js'))
      .pipe(gulp.dest('js'))

    );
});


// ===================================================
// Monitorin'
// ===================================================

gulp.task('watch', function() {
  gulp.watch([
    glob.sass
  ], ['sass']);
 
});


// ===================================================
// Taskin'
// ===================================================

gulp.task('default', [ 'sass', 'watch' ]);