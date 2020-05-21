
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">评论管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                        <li class="breadcrumb-item active"><a href="#">评论管理</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">评论管理</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-fixed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>文章ID</th>
                            <th>关联ID</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>主页</th>
                            <th style="width: 200px">内容</th>
                            <th>时间</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k=>$v)
                            <tr>
                                <td>{{ $v['id'] }}.</td>
                                <td>{{ $v->article->title }}</td>
                                <td>{{ $v['parent_id'] }}</td>
                                <td>{{ $v['name'] }}</td>
                                <td>{{ $v['email'] }}</td>
                                <td>{{ $v['web_site'] }}</td>
                                <td class="table-content" data-toggle="tooltip" data-placement="top" title="{{ $v['content'] }}">{{ $v['content'] }}</td>
                                <td>{{ $v->getRawOriginal('created_at') }}</td>
                                <td>
                                    <button data-url="{{ admin_url('comment/'.$v['id'].'/edit') }}" class="btn btn-outline-dark btn-sm edit rounded-0">编辑</button>
                                    <button data-url="{{ admin_url('comment/'.$v['id']) }}" class="btn btn-outline-danger btn-sm deleted rounded-0">删除</button>
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
    </section>
    <style>

        /*table{*/
        /*    width:100px;*/
        /*    table-layout:fixed;!* 只有定义了表格的布局算法为fixed，下面td的定义才能起作用。 *!*/
        /*}*/

        .table-content{
            width: 200px;overflow: hidden;
            word-break:keep-all;/* 不换行 */
            white-space:nowrap;/* 不换行 */
            text-overflow:ellipsis;/* 当对象内文本溢出时显示省略标记(...) ；需与overflow:hidden;一起使用*/
        }

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

    $('.table-content').tooltip()


    $('.edit').on('click',function () {
        window.location.href = $(this).data('url');
    });

    $('.deleted').on('click',function () {
       console.log($(this).data('url'))

        let url = $(this).data('url');
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
                console.log(url)
                $.ajax({
                    url:url,
                    type:"DELETE",
                    data:{"_method":'DELETE','_token':Config.token},
                    success:function(str){

                        console.log(str)
                        // var data = eval("("+str+")");
                        if(str.success){
                            // 刷新数据


                            toastr.success(str.message);
                            $.pjax.reload('#pjax-container')
                            // swal('提示','删除工单成功!');
                        }else{
                            // $.pjax.reload('#pjax-container')
                            toastr.error(str.message);
                            $.pjax.reload('#pjax-container')
                            // swal('提示','删除工单失败!');
                        }
                    }
                });

            }else{
                console.log("点击取消");
            }
        })
    });
</script>

@endsection