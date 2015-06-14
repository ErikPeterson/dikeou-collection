'use strict';

var env = process.env.NODE_ENV || 'dev';
var gulp = require('gulp');
var sass = require('gulp-sass');
var maps = require('gulp-sourcemaps');

var path = require('path');
var sasspath = path.resolve(__dirname, '../wp-content/themes/dikeou-collection/static/src/scss');
var csspath = path.resolve(__dirname, '../wp-content/themes/dikeou-collection/static/css');

gulp.task('sass', function(){
	if(env === 'dev'){
		return gulp.src(path.join(sasspath, 'style.scss'))
					.pipe(maps.init())
						.pipe(sass())
						.pipe(maps.write('./maps'))
						.pipe(gulp.dest(path.join(csspath)));
	}

	return gulp.src(path.join(sasspath, 'style.scss'))
				.pipe(sass())
				.pipe(gulp.dest(path.join(csspath)));
});


gulp.task('watch', function(){
	gulp.watch(path.join(sasspath, '**/*'), ['sass']);
});