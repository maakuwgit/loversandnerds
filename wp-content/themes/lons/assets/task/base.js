var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifyCss = require('gulp-minify-css');
var notify = require('gulp-notify');
var rename = require('gulp-rename');

gulp.task('base', function() {
    return sass('assets/scss/base/core.scss')
        .pipe(autoprefixer('last 2 versions', {map: false }))
        .pipe(rename('base.css'))
        .pipe(gulp.dest('./assets/css/'))
        .pipe(minifyCss())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./assets/css/'))
        .pipe(notify({ message: 'Styles task complete' }));
});
