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
mix.webpackConfig({ devtool: "inline-source-map" });

mix.sass('resources/sass/app.scss', 'public/css')
   .sourceMaps()
   // .version();
   mix.browserSync({
      proxy: process.env.MIX_SENTRY_DSN_PUBLIC
   });
