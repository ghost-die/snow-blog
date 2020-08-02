@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Dashboard'),
    'activePage' => 'dashboard',
    'active' => '',
])
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Dependencies</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover">

                                @foreach($dependencies as $dependency => $version)
                                    <tr>
                                        <td width="240px">{{ $dependency }}</td>
                                        <td><span class="label label-primary">{{ $version }}</span></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Environment</h4>

                        </div>

                        <!-- /.box-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">

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
    </div>



@endsection