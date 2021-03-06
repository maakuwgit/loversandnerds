/*
    npm install 
    gulp-ruby-sass 
    gulp-newer 
    gulp-autoprefixer 
    gulp-minify-css 
    gulp-concat 
    gulp-uglify 
    gulp-notify 
    gulp-rename 
    gulp-livereload 
    gulp-cache del require-dir --save-dev
*/

var gulp = require('gulp');
var requireDir = require('require-dir')('./assets/task');

gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch('assets/scss/base/**/*.scss', ['base']);
    gulp.watch(['assets/scss/**/*.scss','!assets/scss/*/{base,base/**}'], ['styles']);
});

gulp.task('default', function() {
    gulp.start(['base', 'styles']);
});
