let mix = require("laravel-mix");

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
  .js("resources/assets/js/app.js", "public/js")
  .js("resources/assets/js/carousel.js", "public/js")
  .js("resources/assets/js/filter_panel.js", "public/js")
  .sass("resources/assets/sass/app.scss", "public/css")
  .sass("resources/assets/sass/edit.scss", "public/css")
  .sass("resources/assets/sass/register.scss", "public/css")
  .sass("resources/assets/sass/title.scss", "public/css")
  .sass("resources/assets/sass/userpage.scss", "public/css")
  .sass("resources/assets/sass/lists.scss", "public/css")
  .sass("resources/assets/sass/catalog.scss", "public/css");