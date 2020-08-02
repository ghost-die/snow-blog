
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
                /*toolbar: [
                    {
                        name: "bold",
                        action: SimpleMDE.toggleBold,
                        className: "ri-bold",
                        title: "Bold",
                    },
                    {
                        name: "italic",
                        action: SimpleMDE.toggleItalic,
                        className: "ri-italic",
                        title: "Italic"
                    },
                    {
                        name: "strikethrough",
                        action: SimpleMDE.toggleStrikethrough,
                        className: "ri-strikethrough",
                        title: "Strikethrough"
                    },
                    {
                        name: "heading",
                        action: SimpleMDE.toggleHeadingSmaller,
                        className: "ri-heading",
                        title: "Heading"
                    },
                    {
                        name: "code",
                        action: SimpleMDE.toggleCodeBlock,
                        className: "ri-code-line",
                        title: "Code",
                    },
                    {
                        name: "quote",
                        action: SimpleMDE.toggleBlockquote,
                        className: "ri-double-quotes-l",
                        title: "Quote"
                    },
                    {
                        name: "unordered-list",
                        action: SimpleMDE.toggleUnorderedList,
                        className: "ri-list-unordered",
                        title: "Generic List"
                    },
                    {
                        name: "ordered-list",
                        action: SimpleMDE.toggleOrderedList,
                        className: "ri-list-ordered",
                        title: "Numbered List"
                    },
                    {
                        name: "clean-block",
                        action: SimpleMDE.cleanBlock,
                        className: "ri-eraser-line",
                        title: "Clean block"
                    },
                    {
                        name: "link",
                        action: SimpleMDE.drawLink,
                        className: "ri-link",
                        title: "Create Link"
                    },
                    {
                        name: "image",
                        action: SimpleMDE.drawImage,
                        className: "ri-image-line",
                        title: "Insert Image"
                    },
                    {
                        name: "table",
                        action: SimpleMDE.drawTable,
                        className: "ri-table-2",
                        title: "Insert Table"
                    },
                    {
                        name: "horizontal-rule",
                        action: SimpleMDE.drawHorizontalRule,
                        className: "ri-underline",
                        title: "Insert Horizontal Line"
                    },
                    {
                        name: "preview",
                        action: SimpleMDE.togglePreview,
                        className: "ri-eye-line no-disable",
                        title: "Toggle Preview",
                    },
                    {
                        name: "side-by-side",
                        action: SimpleMDE.toggleSideBySide,
                        className: "ri-layout-column-line no-disable no-mobile",
                        title: "Toggle Side by Side"
                    },
                    {
                        name: "fullscreen",
                        action: SimpleMDE.toggleFullScreen,
                        className: "ri-drag-move-fill no-disable no-mobile",
                        title: "Toggle Fullscreen"
                    },
                    {
                        name: "guide",
                        action: "https://simplemde.com/markdown-guide",
                        className: "ri-question-line",
                        title: "Markdown Guide"
                    },
                    // {
                    //     name: "uploadImage",//自定义按钮
                    //     action: function customFunction(editor) {
                    //         console.log(editor);
                    //     },
                    //     className: "ri-upload-line",
                    //     title: "Upload Image"
                    // }
                ]*/
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

