@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('User'),
    'activePage' => 'user',
    'active' => '',
])

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('User') }}</h4>
                            <p class="card-category">{{ __('Here you can manage users') }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="#" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr><th>
                                                {{ __('Name') }}
                                            </th>
                                            <th>
                                                {{ __('Email') }}
                                            </th>

                                            <th>
                                                {{ __('Avatar') }}
                                            </th>
                                            <th>
                                                {{ __('Created At') }}
                                            </th>
                                            <th class="text-right">
                                                {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $k=>$v)
                                        <tr>
                                            <td>{{ $v['name'] }}</td>
                                            <td>
                                                {{ $v['email'] }}
                                            </td>

                                            <td>
                                                <img style="width: 50px" src="{{ $v['avatar'] }}">
                                            </td>

                                            <td>
                                                {{ $v['created_at'] }}
                                            </td>
                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('admin.user.edit',['user'=>$v['id']]) }}" data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
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
            </div>
        </div>
    </div>


@endsection