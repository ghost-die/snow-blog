

toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};

$.pjax.defaults.timeout = 5000;
$.pjax.defaults.maxCacheLength = 0;
$(document).pjax('a:not(a[target="_blank"])', {
    container: '#pjax-container'
});

NProgress.configure({parent: '#app'});

$(document).on('pjax:timeout', function (event) {
    event.preventDefault();
})

$(document).on('submit', 'form[pjax-container]', function (event) {
    $.pjax.submit(event, '#pjax-container')
});

$(document).on("pjax:popstate", function () {

    $(document).one("pjax:end", function (event) {
        $(event.target).find("script[data-exec-on-popstate]").each(function () {
            $.globalEval(this.text || this.textContent || this.innerHTML || '');
        });
    });
});

$(document).on('pjax:send', function (xhr) {


    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('loading')
        }
    }


    NProgress.start();
});

$(document).on('pjax:complete', function (xhr) {
    if (xhr.relatedTarget && xhr.relatedTarget.tagName && xhr.relatedTarget.tagName.toLowerCase() === 'form') {
        $submit_btn = $('form[pjax-container] :submit');
        if ($submit_btn) {
            $submit_btn.button('reset')
        }
    }


    NProgress.done();
});

$(function () {
    $('.sidebar-menu li:not(.treeview) > a').on('click', function () {


        if ('#' !== $(this).attr('href'))
        {
            $(this).addClass('active');

        }
        var $parent = $(this).parents()



        $parent.siblings(".nav-item").removeClass('menu-open')
        $parent.siblings(".nav-item").children('.nav-treeview').slideUp()
        $parent.siblings(".nav-item").find("> a").removeClass('active')

    });
});

class Ghost{
    constructor() {
        this.setting = {

            'textarea': {
                'id': 'markdown',
            },
            'markdown': {
                resize: 'vertical',
                language: 'zh',
                iconlibrary: 'fa',
                autofocus: false,
                savable: false,
                parser:function (e) {
                    let parser = new HyperDown();
                    return parser.makeHtml(e);
                },
                buttons: [
                    [{
                        name: 'groupFont',
                        data: [{
                            name: 'cmdBold',
                        },{
                            name: 'cmdItalic',
                        },{
                            name: 'cmdHeading',
                        }]
                    },{
                        name: 'groupLink',
                        data: [{
                            name: 'cmdUrl',
                        },{
                            name: 'cmdImage',
                        }]
                    },{
                        name: 'groupMisc',
                        data: [
                            {
                                name: 'cmdList',
                            },
                            {
                                name: 'cmdListO',
                            },
                            {
                                name: 'cmdCode',
                            },
                            {
                                name: 'cmdQuote',
                            }
                        ]
                    },
                        {
                            name: 'groupUtil',
                            data: [{
                                name: 'cmdPreview',
                                toggle: true,
                                hotkey: 'Ctrl+P',
                                title: 'Preview',
                                btnText: 'Preview',
                                btnClass: 'btn-light btn btn-sm',
                            }]
                        }
                    ]
                ],
            }
            ,'uploadUrl': '',
        }
    }

    init(opt){
        this.create($.extend(true, this.setting, opt));
    }

    create(setting){

        let self = this;
        if (document.getElementById(setting.textarea.id)) {
            $(document).ready(function () {
                self.initMarkdown(setting);
            });
        } else {
            console.error('必须先创建好 textarea DOM节点后才可以调用 `init` 方法')
        }
    }

    reload(){
        $.pjax.reload('#pjax-container');
    }

    redirect (url) {
        $.pjax({container:'#pjax-container', url: url });
    }

    getToken () {
        return $('meta[name="csrf-token"]').attr('content');
    };

    initMarkdown(setting){

        setting.markdown.element = $("#"+setting.textarea.id);

        //初始化markdown
        setting.markdown.element.markdown(setting.markdown)

        Dropzone.autoDiscover = false;

        //图片上传
        new Dropzone("#" + setting.textarea.id, {
            url: setting.uploadUrl,
            clickable: false,//to be clickable to select files
            // addRemoveLinks: true,
            method: 'post',
            filesizeBase: 1024,
            headers: {
                'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content
            },
            success: function (file, response, e) {

                console.log(response)

                if (response){

                    let html = setting.markdown.element.val();
                    html += "\n" + '![输入图片说明](' + response.filename + ' "在这里输入图片标题")';
                    setting.markdown.element.val(html);
                }

            }
        });
    }


}


$.ghost = new Ghost();