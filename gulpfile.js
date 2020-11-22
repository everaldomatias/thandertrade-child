var gulp   = require('gulp');
var sass   = require('gulp-sass');
var watch = require('gulp-watch');
var livereload = require('gulp-livereload');
// var jshint = require('gulp-jshint');
// var uglify = require('gulp-uglify');
// var rename = require('gulp-rename');

//sass
// gulp.task('sass', function() {
// 	return gulp.src('./assets/sass/style.scss')
// 		.pipe(sass({outputStyle:"compressed"}))
// 		.pipe(gulp.dest('./assets/css/'));
// });

gulp.task('watching', function () {
	livereload.listen();
	return watch('assets/sass/style.scss', { ignoreInitial: false })
		.pipe(sass({outputStyle:"compressed"}))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(livereload(console.log("watching")));
});

gulp.task('default', gulp.series('watching'));

//jshint
// gulp.task('jshint', function() {
//     return gulp.src('./assets/js/custom.js')
//         .pipe(jshint())
//         .pipe(jshint.reporter('default'));
// });

// uglify
// gulp.task('uglify', function() {
// 	return gulp.src('./assets/js/custom.js')
// 		.pipe(rename('main.min.js'))
// 		.pipe(uglify())
// 		.pipe(gulp.dest('./assets/js/'));
// });

// gulp.task('default', gulp.series('sass', 'jshint', 'uglify'));


