gulp = require 'gulp'

$ = require('gulp-load-plugins')({
  pattern: ['gulp-*', 'run-sequence']
});

sources =
  sass: 'docroot/sites/all/themes/nylottery/assets/scss/**/*.scss'

destinations =
  css: 'docroot/sites/all/themes/nylottery/assets/css'


###
  Compile SASS files
###
gulp.task 'style', ->
  gulp.src(sources.sass)
  .pipe($.plumber())
  .pipe($.sass({compass: true, style: 'expanded'}))
  .on('error', $.sass.logError)
#  .pipe($.minifyCss())
  .pipe(gulp.dest(destinations.css))


###
  Keep watching files for changes to update them automatically
###
gulp.task 'watch', ->
  gulp.watch sources.sass, ['style']


###
  Run tasks to deploy new version
###
gulp.task 'build', [
  'style'
]


###
  Default command to run when calling just "gulp"
###
gulp.task 'default', ['watch']