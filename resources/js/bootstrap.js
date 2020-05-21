window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    SimpleMDE = require('simplemde');

    require('./lib/codemirror');

    require('inline-attachment/src/inline-attachment');
    require('inline-attachment/src/codemirror-4.inline-attachment');
    require('cropperjs');
    require('jquery-cropper');
    require('bootstrap');

    require('select2/dist/js/select2.min');

    // require('bootstrap-iconpicker-latest/dist/js/bootstrap-iconpicker.min');
    window.swal = require('sweetalert/dist/sweetalert.min');

    require('./lib/toastr');

    require('prismjs/prism')
    require('prismjs/components/prism-markup-templating')
    require('prismjs/components/prism-markup')
    require('prismjs/components/prism-css')
    require('prismjs/components/prism-clike')
    require('prismjs/components/prism-javascript')
    require('prismjs/components/prism-docker')
    require('prismjs/components/prism-git')
    require('prismjs/components/prism-json')
    require('prismjs/components/prism-less')
    require('prismjs/components/prism-markdown')
    require('prismjs/components/prism-nginx')
    require('prismjs/components/prism-php')
    require('prismjs/components/prism-php-extras')
    require('prismjs/components/prism-scss')
    require('prismjs/components/prism-sql')
    require('prismjs/components/prism-typescript')
    require('prismjs/components/prism-yaml')
    require('prismjs/components/prism-bash')
    require('prismjs/components/prism-diff')
    require('prismjs/components/prism-go')
    require('prismjs/components/prism-python')
    require('prismjs/components/prism-flow.min')
    require('prismjs/components/prism-factor.min')

    require('prismjs/plugins/line-numbers/prism-line-numbers')
    require('prismjs/plugins/toolbar/prism-toolbar')
    require('prismjs/plugins/previewers/prism-previewers')
    require('prismjs/plugins/autoloader/prism-autoloader')
    require('prismjs/plugins/command-line/prism-command-line')
    require('prismjs/plugins/normalize-whitespace/prism-normalize-whitespace')
    require('prismjs/plugins/keep-markup/prism-keep-markup')
    require('prismjs/plugins/show-language/prism-show-language')
    require('prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard')
    require('prismjs/plugins/treeview/prism-treeview.min')


} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


require('./lib/http-service');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
