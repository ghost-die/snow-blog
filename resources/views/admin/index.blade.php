
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-1 text-dark">主页</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <style>
                .title {
                    font-size: 50px;
                    color: #636b6f;
                    font-family: 'Raleway', sans-serif;
                    font-weight: 100;
                    display: block;
                    text-align: center;
                    margin: 20px 0 10px 0px;
                }

                .links {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .links > a {
                    color: #636b6f;
                    padding: 0 25px;
                    font-size: 12px;
                    font-weight: 600;
                    letter-spacing: .1rem;
                    text-decoration: none;
                    text-transform: uppercase;
                }
            </style>

            <div class="title">
                {{ config('app.name', 'Laravel') }}
            </div>
            <div class="links">

            </div>

        </div>


    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dependencies</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="ri-close-fill"></i>
                                </button>
                            </div>
                        </div>


                        <div class="card-body dependencies">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    @foreach($dependencies as $dependency => $version)
                                        <tr>
                                            <td width="240px">{{ $dependency }}</td>
                                            <td><span class="label label-primary">{{ $version }}</span></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-6">

                    <div class="card card-default">
                        <div class="card-header with-border">
                            <h3 class="card-title">Environment</h3>

{{--                            <div class="card-tools pull-right">--}}
{{--                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
{{--                            </div>--}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="ri-close-fill"></i>
                                </button>
                            </div>

                        </div>

                        <!-- /.box-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">

                                    @foreach($envs as $env)
                                        <tr>
                                            <td width="120px">{{ $env['name'] }}</td>
                                            <td>{{ $env['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection