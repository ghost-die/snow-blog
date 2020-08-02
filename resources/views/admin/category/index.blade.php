@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Category'),
    'activePage' => 'category',
    'active' => '',
])
@section('content')


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="card card-dark">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Category Management') }}</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Article Num') }}</th>
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
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <form method="post"  autocomplete="off" class="form-horizontal" action="{{ admin_url('category') }}">


                        @csrf

                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Create') }}</h4>
{{--                                <p class="card-category">{{ __('User information') }}</p>--}}
                            </div>
                            <div class="card-body ">

                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="" required="true" aria-required="true"/>
                                            @if ($errors->has('name'))
                                                <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection