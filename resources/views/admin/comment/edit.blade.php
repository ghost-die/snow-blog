@extends('admin.layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        {{ __('Article Comment') }}
                    </h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">{{ __('Article Comment') }}</li>
                        <li class="breadcrumb-item active">编辑</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">

            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Created Comment') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('admin.comment.update',['comment'=>$comment->id]) }}" autocomplete="off" class="form-horizontal" pjax-container>
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="col-md-12">


                            <div class="form-group row">
                                <label for="input-content" class="col-sm-2 col-form-label">{{ __('Content') }}</label>
                                <div class="col-sm-8">

                                    <textarea
                                            rows="5"
                                            class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}"
                                            name="content"
                                            id="input-content"
                                            required >{{ old('content') ?? $comment->content  }}</textarea>

                                    @if ($errors->has('content'))
                                        <span id="title-error" class="error text-danger">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="input-name" class="col-sm-2 col-form-label">{{ __('Nick Name') }}</label>
                                <div class="col-sm-8">
                                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nick Name') }}" value="{{ old('name')??$comment->name  }}" required />

                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="input-email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                <div class="col-sm-8">

                                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email')??$comment->email  }}" required />

                                @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="input-web_site" class="col-sm-2 col-form-label">{{ __('Web Site') }}</label>
                                <div class="col-sm-8">


                                    <input class="form-control {{ $errors->has('web_site') ? ' is-invalid' : '' }}" name="web_site" id="input-web_site" type="text" placeholder="{{ __('Web Site') }}" value="{{ old('web_site')??$comment->web_site  }}" required />
                                @if ($errors->has('web_site'))
                                        <span id="web_site-error" class="error text-danger">{{ $errors->first('web_site') }}</span>
                                    @endif
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-white text-center">

                        <button type="submit" class="btn btn-default">{{ __('Save') }} </button>
                        {{--                        <button type="submit" class="btn btn-default float-right">Cancel</button>--}}
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>


</script>

@endpush
