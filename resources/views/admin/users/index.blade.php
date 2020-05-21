
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">用户管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                        <li class="breadcrumb-item active"><a href="#">用户管理</a></li>
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
                        <h3 class="card-title">用户管理</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>头像</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($data as $k=>$v)
                                <tr>
                                    <td>{{ $v['id'] }}.</td>
                                    <td>{{ $v['name'] }}</td>
                                    <td>
                                        {{ $v['email'] }}
                                    </td>
                                    <td> <img style="width: 50px" src="{{ $v['avatar'] }}"></td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>


                    </div>

                    <div class=" clearfix">
                        {{ $data->links() }}
{{--                        <ul class="pagination pagination-sm m-0 float-right">--}}
{{--                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>--}}
{{--                        </ul>--}}
                    </div>

                </div>

            </div>
            <div class="col-md-5">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">新建用户</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ admin_url('user') }}">

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">邮箱地址</label>
                                <input type="email" name="email" class="form-control rounded-0 border-dark" id="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="name">用户名</label>
                                <input type="text" name="name" class="form-control rounded-0 border-dark" id="name" placeholder="Enter name">
                            </div>


                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" name="password" class="form-control rounded-0 border-dark" id="password" placeholder="Password">
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