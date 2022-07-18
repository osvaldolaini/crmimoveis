const mix = require('laravel-mix');
const url = process.env.APP_URL;
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
/*
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/

mix.scripts('resources/views/admin/template/js/main_admin.js', 'public/admin/js/main_admin.js')
    .scripts('resources/views/admin/template/js/app_crud.js', 'public/admin/js/app_crud.js')
    .scripts('resources/views/admin/template/js/jquery.mask.min.js', 'public/admin/js/jquery.mask.min.js')
    .scripts('resources/views/admin/template/upload/app_uploads.js', 'public/admin/template/upload/app_uploads.js')
    .scripts('resources/views/admin/template/upload/app_multipleuploads.js', 'public/admin/template/upload/app_multipleuploads.js')
    .scripts('resources/views/admin/template/switch/app_switch.js', 'public/admin/template/switch/app_switch.js')
    .scripts('resources/views/admin/template/js/recaptcha.js', 'public/admin/js/recaptcha.js')
    .scripts('resources/views/admin/template/validate/app_validate.js', 'public/admin/template/validate/app_validate.js')
    .scripts('resources/views/admin/template/js/app_emails.js', 'public/admin/js/app_emails.js')
    .scripts('resources/views/admin/template/highchart/app_charts.js', 'public/admin/template/highchart/app_charts.js')
    .scripts('resources/views/admin/template/js/app_views.js', 'public/admin/js/app_views.js')
    .scripts('resources/views/admin/template/js/app_cadastros.js', 'public/admin/js/app_cadastros.js')
    .sass('resources/views/admin/template/upload/scss/uploads.scss', 'public/admin/template/upload/uploads.css')
    .sass('resources/views/admin/template/switch/scss/switch.scss', 'public/admin/template/switch/switch.css')
    .sass('resources/views/admin/template/validate/scss/validate.scss', 'public/admin/template/validate/css/validate.css')

.minify([
        'public/admin/template/switch/app_switch.js',
        'public/admin/template/upload/app_uploads.js',
        'public/admin/template/upload/app_multipleuploads.js',
        'public/admin/js/main_admin.js',
        'public/admin/js/app_crud.js',
        'public/admin/js/recaptcha.js',
        'public/admin/template/validate/app_validate.js',
        'public/admin/js/app_emails.js',
        'public/admin/js/app_views.js',
        'public/admin/js/app_cadastros.js',
        'public/admin/template/highchart/app_charts.js',
    ])
    .minify([
        'public/admin/template/switch/switch.css',
        'public/admin/template/upload/uploads.css',
        'public/admin/template/validate/css/validate.css',
    ])
    .copyDirectory('resources/views/admin/template/cards', 'public/admin/template/cards')
    .version();

