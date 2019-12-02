module.exports = function () {
	$.gulp.task('inc', () => {
		return $.gulp.src('./dev/ajax/**/*.*')
			.pipe($.gulp.dest('./build/ajax/'));
	});
};