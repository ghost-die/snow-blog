<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<style>
    .form-control.is-invalid {
        background-image: none !important;
    }
    /*.login-box .card {*/
    /*    border-radius:0;*/
    /*}*/

    .login-box .login-card-body, .register-card-body {
        background: #bfbfbf;
    }
</style>
<script>
    window.Config = {
        'token': "{{ csrf_token() }}",
        'auth': "{{ auth()->check() }}",
        'routes': {
            'upload_md_image': "{{ route('upload_md_image') }}",
        }
    };
</script>
<div class="snow-container">
    <div class="snow foreground"></div>
    <div class="snow foreground layered"></div>
    <div class="snow middleground"></div>
    <div class="snow middleground layered"></div>
    <div class="snow background"></div>
    <div class="snow background layered"></div>
</div>


<body class="hold-transition login-page bg-dark">
    <div id="app">
        <div class="login-box">
                <div class="login-logo">
                    {{ config('app.name', 'Laravel') }}
                </div>
            <div class="card rounded-0">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">{{ __('Sign In') }}</p>

                    <form method="POST" action="{{ route('login') }}">
                        <div class="input-group mb-3 ">
                            <input id="email" type="email" placeholder="{{ __('Email') }}" class="form-control rounded-0  @error('email') is-invalid @else border-dark @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            <div class="input-group-append ">
                                <div class="input-group-text @error('email') is-invalid text-danger @else border-dark @enderror rounded-0">
                                    <i class="ri-mail-line"></i>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="input-group mb-3">
                            <input id="password" type="password"  placeholder="{{ __('Password') }}" class="form-control rounded-0  @error('password') is-invalid @else border-dark  @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text @error('password') is-invalid text-danger @else border-dark  @enderror rounded-0">
                                    <i class="ri-key-2-line"></i>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-outline-dark btn-block rounded-0">{{ __("Sign In") }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>



<script>


    @if ($errors->any())
    @foreach ($errors->all() as $error)

    toastr.error("{{ $error }}");
    @endforeach
    @endif

    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
    toastr.error("{{ session('error') }}");
    @endif

</script>

</html>

