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

 mix.setPublicPath("../public_html");

 mix.combine([
    // Vendo css
    // "../public_html/app-assets/css/material-icon/material_icon.css",
    "../public_html/app-assets/vendors/css/material-vendors.min.css",
    "../public_html/app-assets/vendors/css/forms/selects/select2.min.css",
    // theme
    "../public_html/app-assets/css/material.css",
    "../public_html/app-assets/css/components.css",
    "../public_html/app-assets/css/bootstrap-extended.css",
    "../public_html/app-assets/css/material-extended.css",
    "../public_html/app-assets/css/material-colors.css",
    // Page
    "../public_html/app-assets/css/core/menu/menu-types/material-vertical-menu-modern.css",
    // custom css
    "../public_html/app-assets/vendors/css/forms/selects/select2.custom.css",
   "../public_html/assets/css/style.css",
 ],"../public_html/app-assets/css/combined-style.css")


mix.combine([
    // Vendor
    "../public_html/app-assets/vendors/js/material-vendors.min.js",
    // Theme
    "../public_html/app-assets/js/core/app-menu.js",
    "../public_html/app-assets/js/core/app.js",
    // Page
    "../public_html/app-assets/js/scripts/pages/material-app.js",
    "../public_html/app-assets/js/scripts/pages/snackbar.js",
    // library
    "../public_html/app-assets/vendors/js/forms/select/select2.min.js",
    "../public_html/app-assets/js/axios/axios.min.js"
],"../public_html/mix/js/combined/combined-vendors.js");

mix.combine([
    "../public_html/app-assets/vendors/js/tables/jquery.dataTables.min.js",
    "../public_html/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js",
    "../public_html/app-assets/js/datatable/button.js",
    "../public_html/app-assets/js/datatable/buttons.html5.min.js",
    "../public_html/app-assets/js/datatable/buttons.print.min.js",
    "../public_html/app-assets/js/datatable/jszip.js",
    "../public_html/app-assets/js/datatable/pdfmake.min.js",
    "../public_html/app-assets/js/datatable/vfs_fonts.js",
    // "../public_html/app-assets/vendors/js/forms/icheck/icheck.min.js",
],"../public_html/mix/js/combined/combined-datatable.js");

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
