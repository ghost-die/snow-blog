@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('pages.link'),
    'activePage' => 'pages.link',
    'active' => '',
])



@section('content')

    <div class="content">
        <div class="container">
            <form method="post" action="{{ route('admin.link.store') }}" autocomplete="off" class="form-horizontal">
                @csrf

                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Link') }}</h4>
{{--                        <p class="card-category">{{ __('User information') }}</p>--}}
                    </div>
                    <div class="card-body ">




                        <div class="row">
                            <label for="input-name" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label ">{{ __('Name') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="" required />
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="input-uri" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label">{{ __('Url') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group{{ $errors->has('uri') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('uri') ? ' is-invalid' : '' }}" name="uri" id="input-uri" type="text" placeholder="{{ __('Url') }}" value="" required />
                                    @if ($errors->has('uri'))
                                        <span id="uri-error" class="error text-danger" for="input-uri">{{ $errors->first('uri') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="input-introduction" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label">{{ __('Introduction') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group{{ $errors->has('introduction') ? ' has-danger' : '' }}">
                                    <textarea rows="5" class="form-control {{ $errors->has('introduction') ? ' is-invalid' : '' }}" name="introduction" id="input-introduction"  placeholder="{{ __('Introduction') }}"  ></textarea>
                                    @if ($errors->has('introduction'))
                                        <span id="introduction-error" class="error text-danger" for="input-introduction">{{ $errors->first('introduction') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label for="input-email" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label">{{ __('Email') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="" />
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="input-is_top" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label ">{{ __('Is Top') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group">

                                    <div class="form-check mr-auto mt-3">
                                        <label class="form-check-label">
                                            <input class="form-check-input"  checked name="is_top" value="1" type="radio" > {{ __('Yes') }}
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>

                                        <label class="form-check-label offset-1">
                                            <input class="form-check-input" name="is_top" value="0" type="radio" > {{ __('No') }}
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="input-status" class="col-lg-1 col-md-1 col-sm-1 offset-lg-1 offset-md-1 offset-sm-1 col-form-label">{{ __('Status') }}</label>
                            <div class="col-lg-9 col-md-9 col-sm-9">
                                <div class="form-group ">
                                    <div class="form-check mr-auto mt-3">
                                        <label class="form-check-label">
                                            <input class="form-check-input"  checked name="status" value="1" type="radio" > {{ __('Yes') }}
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>

                                        <label class="form-check-label offset-1">
                                            <input class="form-check-input" name="status" value="0" type="radio" > {{ __('No') }}
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>

                                    </div>
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
@push('css')



@endpush
@push('scripts')


@endpush