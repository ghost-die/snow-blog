
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">分类管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                        <li class="breadcrumb-item active"><a href="#">分类管理</a></li>
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
                            <h3 class="card-title">分类管理</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>名称</th>
                                        <th>文章数</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $k=>$v)
                                    <tr>
                                        <td>{{ $v['id'] }}.</td>
                                        <td>{{ $v['name'] }}</td>
                                        <td>
                                            {{ $v['article_num'] }}
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
                            <h3 class="card-title">新建分类</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ admin_url('category') }}">

                            @csrf
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="name">分类名称</label>
                                    <input type="text" name="name" class="form-control rounded-0 border-dark" id="name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-dark rounded-0">Submit</button>
                                </div>
                            </div>
                            <!-- /.card-body -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection