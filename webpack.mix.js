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
mix.scripts([
    'resources/assets/js/BRD.js',
    'resources/assets/js/MDL.js'
], 'public/js/board.js').version();

mix.scripts([
    'resources/assets/js/SET.js',
    'resources/assets/js/MDL.js'
], 'public/js/setting.js').version();

mix.styles([
    'resources/assets/css/jquery.ui.min.css',
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/docs.css',
    'resources/assets/css/chacha.css',
    'resources/assets/css/dashboard.css'
], 'public/css/common.css').version();

/**
mix.scripts([
    'resources/assets/js/jquery.min.js',
], 'public/js/header.js').version();

mix.scripts([
    'resources/assets/js/jquery.ui.min.js',
    'resources/assets/js/bootstrap.min.js',
    'resources/assets/js/dashboard.js'
], 'public/js/bottom.js').version();

mix.styles([
    'resources/assets/css/jquery.ui.min.css',
    'resources/assets/css/bootstrap.min.css',
    'resources/assets/css/docs.css',
    'resources/assets/css/dashboard.css'
], 'public/css/header.css').version();
*/