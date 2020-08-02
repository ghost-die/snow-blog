@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Article Management'),
    'activePage' => 'article',
    'active' => 'article_index',
])


@section('content')

    <div class="content">
        <div class="container">
            <form method="post" action="{{ route('admin.article.store') }}" autocomplete="off" class="form-horizontal">
                @csrf

                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Created Article') }}</h4>
{{--                        <p class="card-category">{{ __('User information') }}</p>--}}
                    </div>
                    <div class="card-body ">

                        <div class="row">
                            <label for="category_id" class="col-sm-2 col-form-label text-right">{{ __('Category') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">

                                    <select class="form-control  {{ $errors->has('category_id') ? ' is-invalid' : '' }}" id="category_id" required="true" name="category_id" data-placeholder="分类">
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category_id'))
                                        <span id="category_id-error" class="error text-danger" for="category_id">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-2 col-form-label text-right">{{ __('Title') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-email" type="text" placeholder="{{ __('Title') }}" value="" required />
                                    @if ($errors->has('title'))
                                        <span id="title-error" class="error text-danger" for="input-email">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <label for="label" class="col-sm-2 col-form-label text-right">{{ __('Label') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('label') ? ' has-danger' : '' }}">

                                    <select class="form-control  {{ $errors->has('label') ? ' is-invalid' : '' }}" id="label" multiple="multiple" required="true" name="label[]"data-content="true" data-placeholder="{{ __('Label') }}">
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
                        </div>

                        <div class="row">
                            <label for="markdown" class="col-sm-2 col-form-label text-right">{{ __('Content') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group">

                                    <textarea id="markdown" name="content" rows="5"></textarea>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



@endsection
@push('css')
    <link href="{{ asset('assets') }}/plugins/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    <link href="{{ asset('assets') }}/plugins/simplemde-markdown/dist/simplemde.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/article/edit.css" rel="stylesheet" />

@endpush
@push('scripts')
    <script src="{{ asset('assets') }}/plugins/select2-4.0.13/dist/js/select2.min.js"></script>


    <script src="{{ asset('assets') }}/plugins/simplemde-markdown/dist/simplemde.min.js"></script>



    <script src="{{ asset('assets') }}/plugins/InlineAttachment-2.0.3/src/inline-attachment.js"></script>

    <script src="{{ asset('assets') }}/plugins/InlineAttachment-2.0.3/src/codemirror.inline-attachment.js"></script>

    <script src="{{ asset('assets') }}/js/core/markdown.js"></script>

    <script>


        let upload_md_image = "{{ route('upload_md_image') }}";


        $('select').select2(
            {
                tags: true,//允许手动输入，生成标签
                tokenSeparators: [',', ';', '，', '；', ' '],
                width: "100%",
                maximumSelectionSize: 5,
                language: { noResults: function (params) { return "查无结果"; } },
                createTag: function(params) {//解决部分浏览器开启 tags: true 后无法输入中文的BUG
                    if (/[,;，；  ]/.test(params.term)) {//支持【逗号】【分号】【空格】结尾生成tags
                        var str = params.term.trim().replace(/[,;，；]*$/, '');
                        return { id: str, text: str }
                    } else {
                        return null;
                    }
                }
            }
        );

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


        console.log(Config);
        let markdown =new Markdown(upload_md_image);

        markdown.init();
    </script>

@endpush