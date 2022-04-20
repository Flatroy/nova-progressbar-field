let mix = require('laravel-mix');

require('./mix');

mix.setPublicPath('dist')
    .js('resources/js/field.js', 'js')
    .vue({ version: 3 })
    // you need uncomment if you want to add your styles
    //.css('resources/css/field.css', 'css')
    .nova('flatroy/field-progressbar');

// mix.webpackConfig({ devtool: 'inline-source-map' });
