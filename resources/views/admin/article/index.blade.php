@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Article Management'),
    'activePage' => 'article',
    'active' => 'article_index',
])

@section('content')

    <section class="content"  id="pjax-container">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">文章管理</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('admin.article.create') }}" class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                        </div>
                    </div>
                    <div class="table-responsive">
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
                                <td width="200">

                                    <a rel="tooltip" class="btn btn-sm btn-success btn-link" href="{{ route('admin.article.edit',['article'=>$v['id']]) }}"  title="Edit">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a rel="tooltip"  class="btn btn-sm btn-danger btn-link deleted"  data-url="{{ route('admin.article.destroy',['article'=>$v['id']]) }}" title="Delete">
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
        </div>
    </section>

@endsection
@push('css')
    <link href="{{ asset('assets') }}/plugins/sweetalert-2.1.0/docs/assets/css/app.css?v=2.1.0" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets') }}/plugins/sweetalert-2.1.0/docs/assets/sweetalert/sweetalert.min.js"></script>


    <script>
        $('.edit').on('click',function () {
            window.location.href = $(this).data('url');
        });

        $('.deleted').on('click',function () {


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
                    console.log("点击确定")
                    $.ajax({
                        url:url,
                        method:'delete',
                        data:{"_token":window.Config.token},
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