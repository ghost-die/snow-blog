
class Markdown{
    constructor(upload_md_image) {
        this.setting = {

            'textarea': {
                'id': 'markdown',
            },
            'interval': true,
            'markdown': {
                element: document.getElementById('markdown'),
                autoDownloadFontAwesome: false,
                spellChecker: false,
                /*autosave: {
                    enabled: true,
                    delay: 5000,
                    unique_id: "article_content_"
                },*/
                forceSync: true,
                tabSize: 4,

            },
            'uploadUrl': upload_md_image,
            'events': {
                change: function () {},
            }
        }
    }

    init(opt){
        this.create($.extend(true, this.setting, opt));
    }

    create(setting){
        let self = this;
        if (document.getElementById(setting.textarea.id)) {
            $(document).ready(function () {
                self.initSimpleMDE(setting);
            });
        } else {
            console.error('必须先创建好 textarea DOM节点后才可以调用 `init` 方法')
        }
    }

    initSimpleMDE(setting){
        setting.markdown.element = document.getElementById(setting.textarea.id);
        let SimpleMde = window['markdown_' + setting.textarea.id] = new SimpleMDE(setting.markdown);

        if(setting.interval){
            let interval = setInterval(function () {
                if (SimpleMde.isFullscreenActive()) {
                    $('.duke-pulse.editor-fullscreen').hide();
                    $(window).trigger('resize');
                    clearInterval(interval);
                }
            }, 1000);
        }

        SimpleMde.codemirror.on("refresh", function () {
            $(window).trigger('resize');
        });
        SimpleMde.codemirror.on("paste", function () {
            $(window).trigger('resize');
        });
        SimpleMde.codemirror.on("change", function(){
            let markdown = SimpleMde.value();
            setting.events.change(SimpleMde.markdown(markdown));
        });

        // 图片上传
        inlineAttachment.editors.codemirror4.attach(SimpleMde.codemirror, {
            uploadUrl: setting.uploadUrl,
            extraParams: {
                '_token': Config.token,
            },
            onFileUploadResponse: function(xhr) {
                let result = JSON.parse(xhr.responseText),
                    filename = result[this.settings.jsonFieldName];

                if (result && filename) {
                    let newValue;
                    if (typeof this.settings.urlText === 'function') {
                        newValue = this.settings.urlText.call(this, filename, result);
                    } else {
                        newValue = this.settings.urlText.replace(this.filenameTag, filename);
                    }
                    let text = this.editor.getValue().replace(this.lastValue, newValue);
                    this.editor.setValue(text);
                    this.settings.onFileUploaded.call(this, filename);
                }
                return false;
            }
        });
    }
}

