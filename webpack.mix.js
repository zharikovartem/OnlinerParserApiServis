const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
<<<<<<< HEAD
 | for your Laravel application. By default, we are compiling the Sass
=======
 | for your Laravel applications. By default, we are compiling the CSS
>>>>>>> first commit
 | file for the application as well as bundling up all the JS files.
 |
 */

<<<<<<< HEAD
mix.react('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
=======
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
>>>>>>> first commit
