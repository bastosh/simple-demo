let gulp          = require('gulp');
let $             = require('gulp-load-plugins')();
let autoprefixer  = require('autoprefixer');
let runSequence   = require('run-sequence');

let sassPaths = [
    'node_modules/foundation-sites/scss',
    'node_modules/motion-ui/src'
];

gulp.task('sass', () => {
    return gulp
        .src(['src/scss/app.scss', 'src/scss/admin.scss', 'src/scss/demo.scss'])
        .pipe($.sass({
            includePaths: sassPaths,
            // outputStyle: 'compressed'
        })
            .on('error', $.sass.logError))
        .pipe($.postcss([
            autoprefixer({ browsers: ['last 2 versions', 'ie >= 9'] })
        ]))
        .pipe(gulp.dest('public/css'))
});

gulp.task('purgecss', () => {
    return gulp
        .src(['public/css/app.css', 'public/css/admin.css'])
        .pipe(
            $.purgecss({
                content: ['src/templates/**/*.twig', 'app/views/**/*.php']
            })
        )
        .pipe(gulp.dest('public/css'))
});

gulp.task('nano', () => {
    return gulp
        .src(['public/css/app.css', 'public/css/admin.css', 'public/css/demo.css'])
        .pipe($.cssnano())
        .pipe(gulp.dest('public/css'))
});

gulp.task('watch', () => {
    gulp.watch('src/scss/**/*.scss', ['sass']);
});

gulp.task('default', ['sass', 'watch']);

gulp.task('prod', () => {
    runSequence('sass', 'nano');
});
