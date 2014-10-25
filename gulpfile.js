var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass("app.scss")
        .scripts([
        "vendor/jquery-2.1.1.js",
        "vendor/bootstrap-3.2.0.js",
        "vendor/chosen.js",
        "vendor/epiceditor.js",
        "vendor/highlight.js",
        "chosen.js",
        "epiceditor.js"
    ], 'resources/assets/js/');
});
