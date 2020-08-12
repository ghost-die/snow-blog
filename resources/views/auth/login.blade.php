<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>{{ config('ghost.title') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Login') }}</p>

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-group ">

                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" aria-invalid="true" aria-describedby="email-error" id="email" placeholder="{{ __('Email...') }}" value="{{ old('email', 'ghost@ghost-ai.com') }}">


                    @if ($errors->has('email'))

                        <span id="email-error" class="error invalid-feedback">{{ $errors->first('email') }}</span>

                    @endif

                </div>

                <div class="form-group">


                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" aria-invalid="true" aria-describedby="password-error" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "123123" : "" }}" required>

                    @if ($errors->has('password'))

                        <span id="password-error" class="error invalid-feedback">{{ $errors->first('password') }}</span>

                    @endif
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember" id="remember">
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{--                <div class="social-auth-links text-center mb-3">--}}
            {{--                    <p>- OR -</p>--}}
            {{--                    <a href="#" class="btn btn-block btn-primary">--}}
            {{--                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
            {{--                    </a>--}}
            {{--                    <a href="#" class="btn btn-block btn-danger">--}}
            {{--                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
            {{--                    </a>--}}
            {{--                </div>--}}
            {{--                <!-- /.social-auth-links -->--}}

            {{--                <p class="mb-1">--}}
            {{--                    <a href="forgot-password.html">I forgot my password</a>--}}
            {{--                </p>--}}
            {{--                <p class="mb-0">--}}
            {{--                    <a href="register.html" class="text-center">Register a new membership</a>--}}
            {{--                </p>--}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>