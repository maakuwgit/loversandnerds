var gulp = require('gulp');
var sassdoc = require('sassdoc');

gulp.task('sassdoc', function () {
  return gulp.src('assets/scss/core.scss')
    .pipe(sassdoc());
});
