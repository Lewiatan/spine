var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var run = require('gulp-run');
var notify = require('gulp-notify');

gulp.task('test', function() {
    gulp.src('spec/**/*.php')
        .pipe(phpspec('', { clear: true, notify: true, verbose: 'v' }))
        .on('error', notify.onError({
            'title': 'D\'oh!',
            'message': 'Your tests failed, buddy',
            'icon' : __dirname + '/fail.png'
        }))
        .pipe(notify({
            'title': 'Success',
            'message': 'All good here',
            'icon' : __dirname + '/success.png',
            'onLast' : true
        }));
});

gulp.task('watch', function() {
    gulp.watch(['spec/**/*.php', 'spine/**/*.php'],['test']);
});

gulp.task('default', ['test', 'watch']);