
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    // The public path used by the web server to access the previous directory.
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('js/vue', './assets/js/vue.js')
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('css/main', './assets/css/main.css')

    // Enable Vue loader.
    .enableVueLoader()
    // Adding jquery.
    .autoProvidejQuery()
    // Enable sass.
    .enableSassLoader()

module.exports = Encore.getWebpackConfig();