module.exports = function () {
    $.gulp.task('php', () => {
        return $.gulp.src('./dev/**/*.php')
            .pipe($.gulp.dest('./build/'));
    });
};