let mix = require('laravel-mix');
let webpack = require('webpack');

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
 
 mix.webpackConfig({
    externals: {
        // This mean that require('jquery') will refer to global var jQuery
        'jquery': 'jQuery',
    },
    plugins: [
        // ProvidePlugin helps to recognize $ and jQuery words in code
        // And replace it with require('jquery')
        new webpack.ProvidePlugin({
            jQuery: 'jquery',
            $: 'jquery',
            jquery: 'jquery'
        }),
        new webpack.DefinePlugin({
            'require.specified': 'require.resolve'
        })
    ],
});
 
let nodeDir = './node_modules';

mix.js('resources/js/admin/app.js', 'public/js/admin')
    .copy('resources/js/admin/jquery.min.js', 'public/js/admin')    
    .js(
        [            
            nodeDir + '/popper.js/dist/umd/popper.min.js',
            nodeDir + '/datatables.net/js/jquery.dataTables.min.js',
            nodeDir + '/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
            nodeDir + '/datatables.net-buttons/js/dataTables.buttons.min.js',
            nodeDir + '/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
            nodeDir + '/jszip/dist/jszip.min.js',
            nodeDir + '/pdfmake/build/pdfmake.min.js',
            nodeDir + '/pdfmake/build/vfs_fonts.js',
            nodeDir + '/datatables.net-buttons/js/buttons.html5.min.js',
            nodeDir + '/datatables.net-buttons/js/buttons.print.min.js',
            nodeDir + '/datatables.net-buttons/js/buttons.colVis.min.js',
            'resources/js/admin/layout-main.js',          
        ], 
        'public/js/admin/layout.js'
    )
    .sass('resources/sass/app.scss', 'public/css')    
    .styles(
        [
            'node_modules/themify-icons/css/themify-icons.css',
            'node_modules/selectFX/css/cs-skin-elastic.css',
            'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
            'node_modules/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css',
            'resources/css/admin/googleapis.css',
            'resources/css/admin/style.css',
        ], 
        'public/css/admin/layout.css'
    );