const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/assets/painel/js/vendor.js', 'public/panel/js')
    //.vue()
    .sass('resources/assets/painel/sass/app.scss', 'public/panel/css')

    .scripts([
        'resources/assets/painel/js/painel.js',
        'resources/assets/painel/js/libs/bootstrap-table/bootstrap-table.js',
    ], 'public/panel/js/painel.js')

    .sourceMaps()
    .version();
