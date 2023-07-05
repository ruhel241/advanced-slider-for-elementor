let mix = require('laravel-mix');
mix.setPublicPath('assets');

mix.copy('resources/images', 'assets/images');
mix.sass('resources/sass/ase-slider.scss', 'assets/css/ase-slider.css');
mix.sass('resources/sass/ase-editor.scss', 'assets/css/ase-editor.css');
mix.sass('resources/sass/ase-admin.scss', 'assets/css/ase-admin.css');

mix.js('resources/js/ase-slider.js', 'assets/js/ase-slider.js');
mix.js('resources/js/ase-admin.js', 'assets/js/ase-admin.js');


