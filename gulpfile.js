var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    browserSync = require('browser-sync').create(),
    runSequence = require('run-sequence');

var deployPath = '/Users/udit/Sites/php-quiz';

/*
    compile SASS/SCSS files
    minify + autoprefixer
    merge all the files in single style.css
    src: assets/css/
    dest: src/assets/css/
*/
gulp.task('compileCSS', function() {
    return sass('./assets/css', { style: 'expanded' })
        .pipe(minifycss())
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./src/assets/css'));
});

/*
    uglify JS
    merge all the files in single script.js
    src: assets/js/
    dest: src/assets/js/
*/
gulp.task('compileJS', function(){
    return gulp.src('./assets/js/*.js')
        .pipe(concat('script.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./src/assets/js'));
});

/*
    move all the files from src to dest
    src: src/
    dest: deployPath/
*/
gulp.task('deploy', function () {
    gulp.src(['./src/**/*']).pipe(gulp.dest(deployPath));
});

/*
    browserSync port: 3000
*/
gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: {
            target: "http://php-quiz.dev"
        }
    });
});

/*
    compile CSS and JS
    when done deploy the project
    finally reload browser
*/
gulp.task('build', function () {
    runSequence(
		['compileCSS', 'compileJS'],
		'deploy',
        browserSync.reload
	);
});

/*
    if change detected in SASS/JS/PHP file
    build project
*/
gulp.task('watch', function() {
    gulp.watch('./assets/css/*.sass', ['build']);
    gulp.watch('./assets/js/*.js', ['build']);
    gulp.watch('./src/**/*.php', ['build']);
});

gulp.task('default', ['build', 'watch', 'browser-sync'], function() {

});
