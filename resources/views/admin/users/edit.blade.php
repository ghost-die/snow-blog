@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('User'),
    'activePage' => 'user',
    'active' => '',
])

@section('content')
    <div class="content">
        <div class="container">
            <form method="post" action="{{ route('admin.user.update',['user'=>$data['id']]) }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('put')

                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Edit Profile') }}</h4>
                        <p class="card-category">{{ __('User information') }}</p>
                    </div>
                    <div class="card-body ">

                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', $data->name) }}" required="true" aria-required="true"/>
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', $data->email) }}" required />
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
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
@endsection