var Encore = require('@symfony/webpack-encore');
Encore
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('js/vue', './assets/js/vue.js')
    //.addEntry('js/second', './assets/js/second.js')

    // Enable Vue loader
    .enableVueLoader()

module.exports = Encore.getWebpackConfig();