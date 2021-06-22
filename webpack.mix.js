const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue();
mix.postCss('resources/sass/app.css', 'public/css', [
    require('tailwindcss')
]);

if (mix.inProduction()) {
    mix.version();
}
