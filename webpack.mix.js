const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/registration.js', 'public/js')
    .js('resources/js/charts/organization.js', 'public/js/charts')
    .js('resources/js/charts/usersByCourse.js', 'public/js/charts')
    .js('resources/js/charts/events.js', 'public/js/charts')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]).minify('public/assets/js/soft-ui-dashboard.js');
mix.sass('public/assets/scss/soft-ui-dashboard.scss', 'public/assets/css');
mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');
