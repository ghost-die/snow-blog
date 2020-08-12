<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">{{ __('Created Link') }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" action="{{ route('admin.link.store') }}" autocomplete="off" class="form-horizontal" pjax-container >
        @csrf
        <div class="card-body">
            <div class="col-md-12">



                <div class="form-group row">
                    <label for="input-name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="" required />
                        @if ($errors->has('name'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label for="input-uri" class="col-sm-2 col-form-label">{{ __('Url') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('uri') ? ' is-invalid' : '' }}" name="uri" id="input-uri" type="text" placeholder="{{ __('Url') }}" value="" required />
                        @if ($errors->has('uri'))
                            <span id="uri-error" class="error text-danger">{{ $errors->first('uri') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="input-introduction" class="col-sm-2 col-form-label">{{ __('Introduction') }}</label>
                    <div class="col-sm-10">
                        <textarea rows="5" class="form-control {{ $errors->has('introduction') ? ' is-invalid' : '' }}" name="introduction" id="input-introduction"  placeholder="{{ __('Introduction') }}"  ></textarea>
                        @if ($errors->has('introduction'))
                            <span id="introduction-error" class="error text-danger">{{ $errors->first('introduction') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                    <div class="col-sm-10">
                        <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="" />
                        @if ($errors->has('email'))
                            <span id="email-error" class="error text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-2 ">
                        {{ __('Is Top') }}
                    </label>
                    <div class="col-sm-8 ">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="is_top1" name="is_top" value="1">
                            <label for="is_top1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="is_top2" checked name="is_top" value="0">
                            <label for="is_top2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-2 ">
                        {{ __('Status') }}
                    </label>
                    <div class="col-sm-8 ">
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="status1"  checked name="status" value="1" >
                            <label for="status1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="icheck-primary d-inline">
                            <input type="radio" id="status2" name="status" value="0">
                            <label for="status2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">

            <button type="submit" class="btn btn-default">{{ __('Save') }} </button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
