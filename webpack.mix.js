let mix = require('laravel-mix');

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

mix.disableSuccessNotifications()
   .js('resources/assets/js/app.js', 'public/js')
   .sourceMaps()
   .webpackConfig({
     module: {
       rules: [
         {
           test: /\.tsx?$/,
           loader: 'ts-loader',
           options: {
            appendTsSuffixTo: [
              /\.vue$/,
            ],
           },
           exclude: /node_modules/,
         },
       ],
     },
     resolve: {
       extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],
     },
   })
   .sass('resources/assets/sass/app.scss', 'public/css')
   .version();
