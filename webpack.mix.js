const mix = require('laravel-mix');



if (!mix.inProduction()) {
    mix.sourceMaps();
}
mix.autoload({
    jquery: ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
    'popper.js/dist/umd/popper.js': ['Popper']
})
.js(['node_modules/bootstrap/dist/js/bootstrap.min.js'], 'public/js/bootstrap.min.js')
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css/bootstrap.min.css');
