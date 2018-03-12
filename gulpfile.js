/*
npm i -save-dev gulp
npm i -save-dev gulp-sass
npm i -save-dev gulp-clean-css
npm i -save-dev gulp-autoprefixer
npm i -save-dev browser-sync
*/


var gulp = require('gulp');
// var browserSync = require('browser-sync').create();
var sass = require('gulp-sass');
var cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

gulp.task('sass', function() {
    return gulp.src('./src/scss/**/*.scss')
        .pipe(sass.sync().on('error', sass.logError))
});

gulp.task('sass', function() {
    return gulp.src("./src/scss/*.scss")
        .pipe(sass())
        .pipe(gulp.dest('./www/dummy/css'))
        // .pipe(browserSync.stream());
});

gulp.task('minify-css', function() {
    return gulp.src('./www/dummy/css/*.css')
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(gulp.dest('./www/css'));
});

gulp.task('serve', ['sass'], function() {
    // browserSync.init({
    //     server: "./www"
    // });
    gulp.watch("./src/scss/*.scss", ['sass']);
    gulp.watch('./www/dummy/css/**/*.css', ['minify-css']);
    // gulp.watch("./www/*.html").on('change', browserSync.reload);
});

gulp.task('default', ['serve']);
