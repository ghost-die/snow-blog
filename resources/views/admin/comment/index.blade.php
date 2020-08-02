@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Article Comment'),
    'activePage' => 'article',
    'active' => 'article_comment',
])


@section('content')


    <section class="content"  id="pjax-container">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">评论管理</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-fixed">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>文章名称</th>
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
                                <td width="200">

                                    <a rel="tooltip" class="btn btn-sm btn-success btn-link" href="{{ route('admin.comment.edit',['comment'=>$v['id']]) }}"  title="Edit">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a rel="tooltip"  class="btn btn-sm btn-danger btn-link deleted"  data-url="{{ route('admin.comment.destroy',['comment'=>$v['id']]) }}" title="Delete">
                                        <i class="material-icons">delete</i>
                                        <div class="ripple-container"></div>
                                    </a>
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

@endsection

@push('css')
    <link href="{{ asset('assets') }}/plugins/sweetalert-2.1.0/docs/assets/css/app.css?v=2.1.0" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/sweetalert-2.1.0/docs/assets/sweetalert/sweetalert.min.js"></script>


    <script>
    // $('.table-content').tooltip()


    $('.deleted').on('click',function () {
       console.log($(this).data('url'))

        let url = $(this).data('url');
        swal({
            title: "确定要删除该评论吗？",
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
                    success:function(data){

                        console.log(data)

                        if(data.status==='success'){
                            // 刷新数据

                            $.pjax.reload('#pjax-container');
                            md.notification("删除成功",'primary','add_alert')

                        }else{
                            md.notification("删除失败",'danger','error')
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        md.notification("删除失败",'danger','error')
                    }
                });

            }else{
                console.log("点击取消");
            }
        })
    });

    </script>
@endpush