
<div class="card card-default">
    <div class="card-header  border-bottom-0">

        <div class="float-right">
            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="{{ route('admin.article.create') }}" class="btn btn-sm btn-success" title="{{ __('Add') }}">
                    <i class="fa fa-plus"></i><span class="">&nbsp;&nbsp;{{ __('Add') }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body  p-0">

        <div class="table-responsive">
            <table class="table table-hover ">
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

                            <a class="btn btn-sm btn-success" href="{{ route('admin.article.edit',['article'=>$v['id']]) }}"  title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button  class="btn btn-sm btn-danger deleted"  data-url="{{ route('admin.article.destroy',['article'=>$v['id']]) }}" title="Delete">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            {{ $data->links() }}
        </div>
    </div>

</div>

<script data-exec-on-popstate>

    $(function () {
        $('.edit').on('click',function () {
            window.location.href = $(this).data('url');
        });

        $('.deleted').on('click',function () {


            let url = $(this).data('url');

            Swal.fire({
                title: '确定要删除该文章吗?',
                text: "该操作不可恢复!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url:url,
                        method:'delete',
                        headers: {
                            'X-CSRF-Token': document.head.querySelector('meta[name="csrf-token"]').content
                        },
                        success:function(data){
                            if(data.status==='success'){
                                // 刷新数据
                                $.ghost.reload();
                                toastr.success("删除成功")

                            }else{
                                toastr.error("删除失败")
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            toastr.error("删除失败" )
                        }
                    });


                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                }
            })
        });
    })


</script>