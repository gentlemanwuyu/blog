var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('node_modules/layui-src/dist','public/assets/layui-src/dist');
    mix.copy('node_modules/jstree/dist','public/assets/jstree/dist');
    mix.copy('node_modules/jquery/dist','public/assets/jquery/dist');
    mix.copy('node_modules/tinymce','public/assets/tinymce');
    mix.copy('resources/assets/tinymce/langs','public/assets/tinymce/langs');
    mix.copy('resources/assets/tinymce/plugins/powerpaste','public/assets/tinymce/plugins/powerpaste');
    mix.copy('resources/assets/js','public/assets/js');
    mix.copy('resources/assets/css','public/assets/css');
    mix.copy('resources/assets/img','public/assets/img');
    mix.copy('resources/assets/layui-plugins','public/assets/layui-plugins');
    mix.copy('resources/assets/layuiadmin','public/assets/layuiadmin');
    mix.copy('resources/assets/prism','public/assets/prism');

    // 添加版本管理
    mix.version([
        'assets/css/frontend.css',
        'assets/js/frontend.js',
        'assets/js/backend.js'
    ]);
});
