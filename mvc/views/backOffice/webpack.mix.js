const mix = require('laravel-mix');
const sidebarItems = require('./src/sidebar-items.json');
require('laravel-mix-nunjucks')

mix.sass('src/assets1/scss/app.scss', 'assets1/css')
    .sass('src/assets1/scss/bootstrap.scss', 'assets1/css')
    .sass('src/assets1/scss/pages/auth.scss', 'assets1/css/pages')
    .sass('src/assets1/scss/pages/error.scss', 'assets1/css/pages')
    .sass('src/assets1/scss/pages/email.scss', 'assets1/css/pages')
    .sass('src/assets1/scss/pages/chat.scss', 'assets1/css/pages')
    .sass('src/assets1/scss/widgets/chat.scss', 'assets1/css/widgets')
    .sass('src/assets1/scss/widgets/todo.scss', 'assets1/css/widgets')
    .setPublicPath('dist')
    .options({
        processCssUrls: false
    });

// mix.js('node_modules/apexcharts/dist/apexcharts.min.js', 'assets1/vendors/apexcharts');

mix.browserSync({
    proxy: 'mazer.test',
});

mix.njk('src/', 'dist/', {
    ext: '.html',
    marked: null,
    watch: true,
    data: {
        web_title: "Mazer Admin Dashboard",
        sidebarItems
    },
    block: 'content',
    envOptions: {
        watch: true,
        noCache: true
    },
    manageEnv: (nunjucks) => {
        nunjucks.addFilter('containString', function (str, containStr) {
            if (str == undefined) return false;
            return str.indexOf(containStr) >= 0
        })
        nunjucks.addFilter('startsWith', function (str, targetStr) {
            if (str == undefined) return false;
            return str.startsWith(targetStr)
        })
    },
})
