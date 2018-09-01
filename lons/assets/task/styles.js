var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifyCss = require('gulp-minify-css');
var notify = require('gulp-notify');
var rename = require('gulp-rename');

gulp.task('styles', function() {
    return sass('assets/scss/core.scss')
        .pipe(autoprefixer('last 2 versions', {map: false }))
        .pipe(rename('style.css'))
        .pipe(gulp.dest('./'))
        .pipe(minifyCss())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Styles task complete' }));
});
