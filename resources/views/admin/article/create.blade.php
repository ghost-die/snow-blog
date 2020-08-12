
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">{{ __('Created Article') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{ route('admin.article.store') }}" autocomplete="off" class="form-horizontal" pjax-container>
        @csrf
        <div class="card-body">
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4  {{ $errors->has('category_id') ? 'is-invalid' : '' }}" id="category_id" required="true" name="category_id" data-placeholder="分类">
                            @foreach($categorys as $category)
                                <option value="{{$category->id}}" >{{$category->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('category_id'))
                            <span id="category_id-error" class="error text-danger" for="category_id">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">{{ __('Title') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="title" type="text" placeholder="{{ __('Title') }}" value="" required />
                        @if ($errors->has('title'))
                            <span id="title-error" class="error text-danger" for="input-email">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="label" class="col-sm-2 col-form-label">{{ __('Label') }}</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4  {{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" multiple="multiple" required="true" name="label[]" data-content="true" data-placeholder="{{ __('Label') }}">
                            @if( ! $labels->isEmpty())
                                @foreach($labels as $label)
                                    <option>{{$label->name}}</option>
                                @endforeach
                            @endif
                        </select>

                        @if ($errors->has('category_id'))
                            <span id="label-error" class="error text-danger" for="label">{{ $errors->first('label') }}</span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="markdown" class="col-sm-2 col-form-label">{{ __('Content') }}</label>
                    <div class="col-sm-10">
                        <textarea name="content" id="markdown" rows="10"></textarea>

                    </div>
                </div>

            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">

            <button type="submit" class="btn btn-default">{{ __('Save') }} </button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>

<script data-exec-on-popstate>

    $(function () {
        let upload_md_image = "{{ route('upload_md_image') }}";


        $('select').select2({
            theme: 'bootstrap4',
            tags: true,//允许手动输入，生成标签
            tokenSeparators: [',', ';', '，', '；', ' '],
            width: "100%",
            maximumSelectionSize: 5,
            language: { noResults: function (params) { return "查无结果"; } },
            createTag: function(params) {//解决部分浏览器开启 tags: true 后无法输入中文的BUG
                if (/[,;，；  ]/.test(params.term)) {//支持【逗号】【分号】【空格】结尾生成tags
                    let str = params.term.trim().replace(/[,;，；]*$/, '');
                    return { id: str, text: str }
                } else {
                    return null;
                }
            }
        });

        //解决输入中文后无法回车结束的问题。
        $(document).on('keyup', '.select2-selection--multiple .select2-search__field', function(event){
            if(event.keyCode === 13){
                var $this = $(this);
                var optionText = $this.val();
                //如果没有就添加
                if(optionText !== "" && $this.find("option[value='" + optionText + "']").length === 0){
                    //我还不知道怎么优雅的定位到input对应的select
                    var $select = $this.parents('.select2-container').prev("select");
                    var newOption = new Option(optionText, optionText, true, true);
                    $select.append(newOption).trigger('change');
                    $this.val('');
                }
            }
        });

        //初始化编辑器


        $.ghost.init({"uploadUrl":upload_md_image});
    });
</script>