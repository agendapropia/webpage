const mix = require('laravel-mix')

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
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  /** Plugins */
  .scripts(
    [
      'resources/js/vendor/plugins/table-gear/table-gear-plugins.js',
      'resources/js/vendor/plugins/table-gear/table-gear.js',
      'resources/js/vendor/plugins/search-by-autocomplete.js',
      'resources/js/vendor/plugins/upload-s3/upload-s3.js',
      'resources/js/vendor/plugins/moment/moment.js',
      'node_modules/flatpickr/dist/flatpickr.min.js',
      'resources/js/util/flatpickr.js',
      'resources/js/util/change-password-user.js',
    ],
    'public/js/plugins.all.js',
  )

  .styles(
    [
      'resources/css/app.css',
      'node_modules/flatpickr/dist/flatpickr.css',
      'resources/js/vendor/plugins/upload-s3/upload-s3.css',
      'resources/css/vendor/plugins/table_gear/table_gear.css',
      'resources/css/vendor/plugins/table_gear/plugins_table_tech.css',
      'resources/css/vendor/plugins/icheck/all.css',
      'resources/css/vendor/plugins/search-autocomplete.css',
    ],
    'public/css/plugins.all.css',
  )
  .sass('resources/css/web/global.scss', 'public/css/web/web-plugins.all.css')
  .scripts(['resources/js/web/**/*.js'], 'public/js/web/all.js')

  /** Modules Scripts */
  .scripts(
    [
      'resources/js/modules/users/list.js',
      'resources/js/modules/users/create.js',
      'resources/js/modules/users/update.js',
      'resources/js/modules/users/status.js',
      'resources/js/modules/users/assign.js',
    ],
    'public/js/modules/users/all.js',
  )
  .scripts(
    [
      'resources/js/modules/permissions/permissions-assign.js',
      'resources/js/modules/permissions/roles-list.js',
      'resources/js/modules/permissions/roles-create.js',
      'resources/js/modules/permissions/roles-update.js',
    ],
    'public/js/modules/permissions/roles-all.js',
  )
  .scripts(
    [
      'resources/js/modules/permissions/permissions-list.js',
      'resources/js/modules/permissions/permissions-create.js',
      'resources/js/modules/permissions/permissions-update.js',
    ],
    'public/js/modules/permissions/permissions-all.js',
  )
  .scripts(
    [
      'resources/js/modules/configurations/regions/list.js',
      'resources/js/modules/configurations/regions/create.js',
      'resources/js/modules/configurations/regions/update.js',
    ],
    'public/js/modules/configurations/regions/all.js',
  )
  .scripts(
    [
      'resources/js/modules/configurations/tags/list.js',
      'resources/js/modules/configurations/tags/create.js',
      'resources/js/modules/configurations/tags/update.js',
    ],
    'public/js/modules/configurations/tags/all.js',
  )
  .scripts(
    [
      'resources/js/modules/specials/module/list.js',
      'resources/js/modules/specials/module/create.js',
      'resources/js/modules/specials/module/update.js',
      'resources/js/modules/specials/module/users.js',
    ],
    'public/js/modules/specials/module/all.js',
  )
  .scripts(
    ['resources/js/modules/utils/images/selections.js'],
    'public/js/modules/utils/images/all.js',
  )
