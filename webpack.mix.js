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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
      processCssUrls: false
   })
   .webpackConfig({
      plugins: [
         new BrowserSyncPlugin({
            proxy: 'localhost:8000',
            files: [
               'public/**/*.{css,js}',
               'resources/views/**/*.blade.php',
               'routes/**/*.php',
               'public/images/**/*.{jpg,png,jpeg}'
            ],
            notify: false,
            open: false,
         })
      ]
   });

    