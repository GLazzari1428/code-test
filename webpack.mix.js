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

// While in production, process CSS discarding comments
if (mix.inProduction()) {
	mix.options({
		postCss: [
			require('postcss-discard-comments')({
				removeAll: true
			})
		],
		uglify: {
			uglifyOptions: {
				comments: false
			},
		}
	})
}

// Compile js
mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.options({
		processCssUrls: false
	});

mix.disableNotifications();
mix.browserSync({ proxy: 'localhost:8000' });
