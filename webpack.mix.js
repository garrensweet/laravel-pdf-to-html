const mix = require('laravel-mix')

mix.webpackConfig({
    resolve: {
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
})

mix.ts('resources/js/main.ts', 'public/js').sass(
    'resources/sass/app.scss',
    'public/css'
)
