
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">文章管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                        <li class="breadcrumb-item active"><a href="#">文章管理</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">编辑文章</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ admin_url('article/'.$article->id) }}">
                        <input type="hidden" name="_method" value="PUT">

                    @csrf

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label text-right">分类</label>
                        <div class="col-sm-10">
                            <select class="form-control @error('category_id') is-invalid @enderror " required  name="category_id"   data-placeholder="分类">
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}" @if(in_array($category->id,$article->category->pluck('id')->toArray())) selected @endif >{{$category->name}}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-right">标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  rounded-0  @error('title') is-invalid @else border-dark @enderror" id="title" name="title" placeholder="标题" required value="{{ old('title')??$article->title  }}" autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="label" class="col-sm-2 col-form-label text-right">标签</label>
                        <div class="col-sm-10">

                            <select class="form-control  @error('label') is-invalid @enderror " required  multiple="multiple" name="label[]" data-content="true" data-placeholder=" 标签">

                                @if( ! $labels->isEmpty())

                                    @foreach($labels as $label)
                                        <option @if(in_array($label->name,$article->label->pluck('name')->toArray())) selected @endif>{{$label->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right" for="markdown">内容</label>
                        <div class="col-sm-10">
                            <textarea class="form-control  @error('content') is-invalid @enderror" id="markdown" name="content" required rows="5">{{ $article->original_content }}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit"  class="btn btn-outline-dark">提交</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </section>
    <style>

    </style>
@endsection
@section('script')
<script>

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

    window.markdown.init();
</script>

@endsection