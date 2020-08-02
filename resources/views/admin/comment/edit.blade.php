@extends('admin.layouts.app', [
    'class' => 'dark-edition ',
    'titlePage' =>__('Article Comment'),
    'activePage' => 'article',
    'active' => 'article_comment',
])


@section('content')



    <section class="content">
        <div class="container">
            <form method="post" action="{{route('admin.comment.update',['comment'=>$comment->id]) }}" autocomplete="off" class="form-horizontal">
                <div class="card">
                    <div class="card-header-primary ">
                        <h4 class="card-title">编辑文章</h4>
                    </div>

                    <div class="card-body">


                        @csrf
                        @method('put')

                        <div class="row">
                            <label for="input-content" class="col-sm-2 col-form-label text-right">{{ __('Content') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                                    <textarea
                                            rows="5"
                                            class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}"
                                            name="content"
                                            id="input-content"
                                            required >{{ old('content') ?? $comment->content  }}</textarea>


                                    @if ($errors->has('content'))
                                        <span id="content-error" class="error text-danger" for="input-content">{{ $errors->first('content') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="input-name" class="col-sm-2 col-form-label text-right">{{ __('Nick Name') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nick Name') }}" value="{{ old('name')??$comment->name  }}" required />
                                    @if ($errors->has('name'))
                                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label for="input-email" class="col-sm-2 col-form-label text-right">{{ __('Email') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email')??$comment->email  }}" required />
                                    @if ($errors->has('email'))
                                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label for="input-web_site" class="col-sm-2 col-form-label text-right">{{ __('Web Site') }}</label>
                            <div class="col-sm-9">
                                <div class="form-group{{ $errors->has('web_site') ? ' has-danger' : '' }}">
                                    <input class="form-control {{ $errors->has('web_site') ? ' is-invalid' : '' }}" name="web_site" id="input-web_site" type="text" placeholder="{{ __('Web Site') }}" value="{{ old('web_site')??$comment->web_site  }}" required />
                                    @if ($errors->has('web_site'))
                                        <span id="web_site-error" class="error text-danger" for="input-web_site">{{ $errors->first('web_site') }}</span>
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
    </section>

@endsection

@push('scripts')
<script>


</script>

@endpush
