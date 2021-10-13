const Encore = require('@symfony/webpack-encore');

Encore
    .enableSingleRuntimeChunk()
    .setOutputPath('public/build/')
    // The public path used by the web server to access the previous directory.
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('js/home', './assets/js/home.js')
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/admin', './assets/js/admin.js')
    .addEntry('js/blog', './assets/js/blog.js')
    .addEntry('js/style_tags.js', './assets/js/style_tags.js')
    .addEntry('css/main', './assets/css/main.css')
    .addEntry('css/icons','./assets/css/icons.css')


    // Enable Vue loader.
    .enableVueLoader()
    // Adding jquery.
    .autoProvidejQuery()
    // Enable sass.
    .enableSassLoader()
    // configure Babel
     //.configureBabel(function (babelConfig) {
      //   babelConfig.presets = ['es2015', 'stage-2'];
//babelConfig.plugins = ['transform-runtime'];
 //    })
    // Enable EsLint
    .addLoader({
        test: /\.js$/,
        enforce: 'pre',
        loader: 'eslint-loader',
        exclude: /node_modules/,
        options: {
            fix: true
        }
    })
;

module.exports = Encore.getWebpackConfig();

