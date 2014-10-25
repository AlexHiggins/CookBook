var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass("app.scss");
    mix.scripts([
        "js/vendor/jquery-2.1.1.js",
        "js/vendor/bootstrap-3.2.0.js",
        "js/vendor/chosen.js",
        "js/vendor/epiceditor.js",
        "js/vendor/highlight.js",
        "js/chosen.js",
        "js/epiceditor.js"
    ]);
});
