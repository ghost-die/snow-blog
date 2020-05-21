
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">文章管理</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>标题</th>
                                        <th>阅读数</th>
                                        <th>评论数</th>
                                        <th>创建时间</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k=>$v)
                                    <tr>
                                        <td>{{ $v['id'] }}.</td>
                                        <td>{{ $v['title'] }}</td>
                                        <td>{{ $v['reads_num'] }}</td>
                                        <td>{{ $v['comments_num'] }}</td>
                                        <td>{{ $v->getRawOriginal('created_at') }}</td>
                                        <td>
                                            <button data-url="{{ admin_url('article/'.$v['id'].'/edit') }}" class="btn btn-outline-dark btn-sm edit rounded-0">编辑</button>
                                            <button data-url="{{ admin_url('article/'.$v['id']) }}" class="btn btn-outline-danger btn-sm deleted rounded-0">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class=" clearfix">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">新建文章</h3>
                        </div>
                        <form method="post" action="{{ admin_url('article') }}">

                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">分类名称</label>
                                    <select class="form-control rounded-0 @error('category_id') is-invalid @else border-dark @enderror " id="category_id" required  name="category_id"   data-placeholder="分类">
                                        @foreach($categorys as $category)
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control rounded-0  @error('title') is-invalid @else border-dark @enderror" id="title" name="title" placeholder="标题" required value="{{ old('title') }}" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <label for="label">标签</label>
                                    <select id="label" class="form-control rounded-0  @error('title') is-invalid @else border-dark @enderror" required  multiple="multiple" name="label[]" data-content="true" data-placeholder=" 标签">
                                        @if( ! $labels->isEmpty())
                                            @foreach($labels as $label)
                                                <option>{{$label->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="markdown">标题</label>
{{--                                    <input type="text" class="form-control rounded-0  @error('title') is-invalid @else border-dark @enderror" id="title" name="title" placeholder="标题" required value="{{ old('title') }}" autocomplete="off" >--}}
                                    <textarea   class="form-control  @error('content') is-invalid @enderror" id="markdown" name="content" required rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-dark rounded-0">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .swal-footer {
            text-align: center;
        }
        .swal-button {
            border:1px solid #343a40;
            color: #343a40;
            background: none;
            border-radius:0 !important;
        }
        .swal-button:focus {
            box-shadow:none !important;
            background-color: #343a40;
            color: #ffffff;
        }

        .swal-button:not([disabled]):hover {
            background-color: #343a40;
            color: #ffffff;
        }
        .swal-button--cancel:not([disabled]):hover{
            background-color: #e8e8e8;
            border-color: #e8e8e8 ;
            color: #343a40;
        }
    </style>
@endsection
@section('script')
<script>

    $('.edit').on('click',function () {
        window.location.href = $(this).data('url');
    });

    $('.deleted').on('click',function () {
       console.log($(this).data('url'))

        swal({
            title: "确定要删除该文章吗？",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "取消",
                    value: "",
                    visible: true,
                    closeModal: true,
                },
                confirm: {
                    text: "确定",
                    value: true,
                    visible: true,
                    closeModal: true
                }
            },
        }).then(function(isConfirm){
            if(isConfirm){
                console.log("点击确定")
                // $.ajax({
                //     url:'<%=path%>/worktask/del',
                //     method:'post',
                //     data:{"ID":id},
                //     success:function(str){
                //         var data = eval("("+str+")");
                //         if(data.success){
                //             // 刷新数据
                //             window.location.reload();
                //             swal('提示','删除工单成功!');
                //         }else{
                //             swal('提示','删除工单失败!');
                //         }
                //     }
                // });
            }else{
                console.log("点击取消");
            }
        })
    });


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