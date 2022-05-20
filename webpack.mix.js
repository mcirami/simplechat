const mix = require('laravel-mix');
require('core-js');
require('laravel-mix-polyfill');

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
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.react()
.sass('resources/sass/app.scss', 'public/css')
.minify('public/js/app.js', 'public/js/app.min.js')
.minify('public/css/app.css', 'public/css/app.min.css')
.polyfill({
    enabled: true,
    useBuiltIns: 'entry',
    targets: false,
    entryPoints: "stable",
    corejs: 3,
});
