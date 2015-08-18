var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    del = require('del');

gulp.task('styles', function() {
  gulp.src('html/scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('html/styles/'))
    .pipe(rename({suffix: '.min'}))
    .pipe(minifycss())
    .pipe(gulp.dest('html/styles/'))
    .pipe(notify({ message: 'Styles task complete' }));
});

gulp.task('watch', function () {
  gulp.watch('html/**/*.scss', ['styles']);
});

gulp.task('scripts', function() {
  return gulp.src('html/scripts/**/*.js')
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('default'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('html/scripts'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('html/scripts'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

gulp.task('images', function() {
  return gulp.src('html/images/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('html/images'))
    .pipe(notify({ message: 'Images task complete' }));
});

gulp.task('clean', function(cb) {
    del(['html/styles/**/*.css'], cb)
});

gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts', 'images', 'watch');
});