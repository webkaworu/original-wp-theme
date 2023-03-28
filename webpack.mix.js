/* globals __dirname */
const path = require('path');
const mix = require('laravel-mix');
const glob = require('glob');
require('laravel-mix-polyfill');

// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

mix.setPublicPath('./src');

// Compile all scss files directly under the sass directory
glob.sync('./build/scss/*.scss', { ignore: './build/scss/_*.scss' }).map(function(file) {
	mix.sass(file, './src/css').options({
		processCssUrls: false,
		postCss       : [
			require('autoprefixer')({
				grid: true
			})
		],
		autoprefixer: {
			options: {
				browsers: ['last 2 versions']
			}
		}
	});
});

// Compile all js files directly under the js directory
mix
	.js('./build/js/app.js', './src/js')
	.js('./build/js/admin.js', './src/js')
	.polyfill({
		enabled    : true,
		useBuiltIns: 'usage',
		targets    : 'IE 11'
	});

// mix.combine('./build/js/block-editor.js', './src/js/block-editor.js', true);

mix
	.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', './src/fonts');

// Generate sourcemap only for development environment
if (mix.inProduction()) {
	// require('laravel-mix-versionhash');
	// mix.versionHash();
} else {
	mix.sourceMaps().webpackConfig({
		devtool: 'inline-source-map'
	});
}

mix.options({
	terser: {
		terserOptions: {
			keep_fnames: true
		}
	}
});

mix.disableNotifications();

// Added webpackConfig settings
mix.webpackConfig({
	module: {
		rules: [
			{
				enforce: 'pre',
				test   : /\.(js|vue)?$/,
				exclude: /node_modules/,
				loader : 'eslint-loader'
			},
			{
				// Allow .scss files imported glob
				test  : /\.scss/,
				loader: 'import-glob-loader'
			}
		]
	},
	plugins: [
		// new BundleAnalyzerPlugin()
		new CleanWebpackPlugin({
			cleanOnceBeforeBuildPatterns: ['src/css/*','src/js/*']
		})
	],
	resolve: {
		extensions: ['.js', '.json', '.vue'],
		alias     : {
			'~': path.join(__dirname, './build/js')
		}
	}
});
