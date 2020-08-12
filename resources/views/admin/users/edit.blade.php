@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        {{ __('User Edit') }}
                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">{{ __('User') }}</li>
                        <li class="breadcrumb-item active">{{ __('Edit Profile') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('admin.user.update',['user'=>$data['id']]) }}" autocomplete="off" class="form-horizontal" pjax-container>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                            <div class="col-sm-8">
                                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name')?? $data->name  }}" required />
                                @if ($errors->has('name'))
                                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                            <div class="col-sm-8">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email')?? $data->email  }}" required />
                                @if ($errors->has('email'))
                                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">

                        <button type="submit" class="btn btn-dark">{{ __('Save') }} </button>

                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>


        </div>
    </section>

@endsection