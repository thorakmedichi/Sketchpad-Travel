const { mix } = require('laravel-mix');

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

mix.copy('node_modules/font-awesome/fonts', 'resources/assets/fonts')
   .copy('node_modules/font-awesome/fonts', 'public/fonts')
   .js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/admin.js', 'public/js')
   .scripts(['resources/assets/js/custom/google-maps.js',
             'resources/assets/js/custom/google-maps-integrations.js'
            ], 'public/js/google-maps/admin.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/sass/admin.scss', 'public/css')
   .sass('resources/assets/sass/errors.scss', 'public/css');
