var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    livereload = require('gulp-livereload');

gulp.task('compile:CSS', function() {
    return sass('./assets/css', { style: 'expanded' })
        .pipe(minifycss())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./src/assets/css'));
});

gulp.task('compile:JS', function(){
    return gulp.src('./assets/js/*.js')
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./src/assets/js'));
});

gulp.task('watch', function() {
    gulp.watch('./assets/css/*.sass', ['compile:CSS']);
    gulp.watch('./assets/js/*.js', ['compile:JS']);
    gulp.watch('./src/**/*.php');
    livereload.listen();
});

gulp.task('default', ['compile:CSS', 'compile:JS','watch'], function() {

});
