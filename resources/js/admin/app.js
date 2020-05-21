require('./bootstrap');

class Markdown{
    constructor() {
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
                toolbar: [
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
                ]
            },
            'uploadUrl': Config.routes.upload_md_image,
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

console.log(Config);
window.markdown =new Markdown;






class MyCropper {

    constructor($element){
        // this.$container = $element;

        this.$avatarModal = $element;

        this.$avatarView = $('.avatar-view');

        this.$avatar = this.$avatarView.find('img');

        this.$overAvatar = this.$avatarView.find('.over-avatar')

        this.$avatarForm = this.$avatarModal.find(".avatar_form");

        this.$avatarUpload = this.$avatarForm.find('.avatar_upload');

        this.$avatarSrc = this.$avatarForm.find('.avatar_src');

        this.$avatarData = this.$avatarForm.find('.avatar_data');

        this.$avatarInput = this.$avatarForm.find(".avatar_input");

        this.$avatarSave = this.$avatarForm.find('.avatar_save');


        this.$avatarWrapper = this.$avatarModal.find('.avatar_wrapper');

        this.$avatarPreview = this.$avatarModal.find('.avatar_preview');

        this.$avatarBtns = this.$avatarForm.find('.avatar-btns');


        this.url = "";

        this.uploaded = false;

        this.active=false;
        this.support={
            fileList: !!$('<input type="file">').prop('files'),
            blobURLs: !!window.URL && URL.createObjectURL,
            formData: !!window.FormData
        }

    }

    init() {
        this.support.datauri = this.support.fileList && this.support.blobURLs;



        this.addListener();
        this.initPreview();
    }
    addListener() {

        this.$overAvatar.bind('click', $.proxy(this.click, this));
        this.$avatarInput.bind('change', $.proxy(this.change, this));
        this.$avatarForm.bind('submit', $.proxy(this.submit, this));
        this.$avatarBtns.bind('click', $.proxy(this.rotate, this));
    }

    rotate(e) {
        let data;

        if (this.active) {
            data = $(e.target).data();
            if (data.method) {
                this.$img.cropper(data.method, data.option);
            }
        }
    }
    click() {
        this.$avatarModal.modal('show');
        this.initPreview();
    }

    isImageFile(file) {
        if (file.type) {
            return /^image\/\w+$/.test(file.type);
        } else {
            return /\.(jpg|jpeg|png|gif)$/.test(file);
        }
    }

    change() {
        let files,
            file;

        if (this.support.datauri) {
            files = this.$avatarInput.prop('files');

            if (files.length > 0) {
                file = files[0];

                if (this.isImageFile(file)) {
                    if (this.url) {
                        URL.revokeObjectURL(this.url); // Revoke the old one
                    }
                    this.url = URL.createObjectURL(file);
                    this.startCropper();
                }
            }
        } else {
            file = this.$avatarInput.val();

            if (this.isImageFile(file)) {

                console.log(file);
                this.syncUpload();
            }
        }
    }

    initPreview() {
        let url = this.$avatar.attr('src');
        this.$avatarPreview.empty().html('<img   src="' + url + '">');
    }

    syncUpload() {
        this.$avatarSave.click();
    }

    startCropper() {
        let _this = this;

        if (this.active) {
            this.$img.cropper('replace', this.url);
        } else {

            this.$img = $('<img   src="' + this.url + '">');
            this.$avatarWrapper.empty().html(this.$img);
            this.$img.cropper({
                aspectRatio: 1,
                number: 3,
                preview: ".avatar_preview",
                strict: false,
                minContainerWidth:250,
                minContainerHeight:250,
                minCanvasWidth:250,
                minCanvasHeight:250,
                resizable:false,
                guides:false,
                background:false,
                movable:true,
                // scalable:false,
                // rotatable:true,
                cropBoxResizable:false,
                // zoomOnWheel:false,
                // zoomOnTouch:false,
                // zoomable:false,
                autoCropArea:1,
                crop: function (event) {
                    let json = [
                        '{"x":' + event.detail.x,
                        '"y":' + event.detail.y,
                        '"height":' + event.detail.height,
                        '"width":' + event.detail.width,
                        '"rotate":' + event.detail.rotate + '}'
                    ].join();

                    _this.$avatarData.val(json);
                }
            });

            this.active = true;
        }
    }

    submit(){
        if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {

            this.alert('请选择文件!')
            return false;
        }

        if (this.support.formData) {
            this.ajaxUpload();

            return false;
        }
    }

    ajaxUpload() {
        let url = this.$avatarForm.attr('action'),
            data = new FormData(this.$avatarForm[0]),
            _this = this;

        console.log(data);
        $.ajax(url, {
            type: 'post',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                _this.submitStart();
            },

            success: function (data) {
                _this.submitDone(data);
            },

            error: function (XMLHttpRequest, textStatus, errorThrown) {
                _this.submitFail(textStatus || errorThrown);
            },

            complete: function () {
                _this.submitEnd();
            }
        });
    }

    submitFail(msg) {
        this.alert(msg);
    }

    submitEnd() {
        console.log('上传结束')

        swal.close();
    }

    submitStart() {

        swal({
            text:'图片正在上传',
            buttons: false,
            imageUrl: "loading.gif",
        })

    }

    submitDone(data) {
        console.log(data);

        if ($.isPlainObject(data) && data.state) {
            if (data.result) {
                this.url = data.result;

                if (this.support.datauri || this.uploaded) {
                    this.uploaded = false;
                    this.cropDone();
                } else {
                    this.uploaded = true;
                    this.$avatarSrc.val(this.url);
                    this.startCropper();
                }

                this.$avatarInput.val('');
            } else if (data.message) {
                this.alert(data.message);
            }
        } else {
            this.alert('Failed to response');
        }
    }

    cropDone() {
        this.$avatarForm.get(0).reset();
        this.$avatar.attr('src', this.url);
        this.stopCropper();
        this.$avatarModal.modal('hide');
    }

    stopCropper() {
        if (this.active) {
            this.$img.cropper('destroy');
            this.$img.remove();
            this.active = false;
        }
    }

    alert(msg) {

        swal(msg, {
            buttons: false,
            icon:'error'
        });

    }
}



window.MyCropper = MyCropper;
