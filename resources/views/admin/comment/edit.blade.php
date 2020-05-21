
@extends('admin.layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">评论管理</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ admin_url('/') }}">首页</a></li>
                        <li class="breadcrumb-item active"><a href="#">评论管理</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">编辑评论</h3>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ admin_url('comment/'.$comment->id) }}">
                        <input type="hidden" name="_method" value="PUT">

                        @csrf

                    <div class="form-group">
                        <label for="content">评论*</label>
                        <textarea style="min-height: 160px" class="form-control rounded-0  @error('content') is-invalid @else border-dark @enderror" id="content" name="content" required  autocomplete="off" >{{ $comment['content'] }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">昵称*</label>
                        <input type="text" class="form-control rounded-0  @error('name') is-invalid @else border-dark @enderror"
                               id="name" name="name" placeholder="Ghost" required value="{{ $comment['name'] }}" autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱*</label>
                        <input type="email" class="form-control rounded-0  @error('email') is-invalid @else border-dark @enderror" id="email" name="email"
                               placeholder="name@email.com" required value="{{  $comment['email']  }}" autocomplete="off" >
                    </div>

                    <div class="form-group">
                        <label for="web_site">主页</label>
                        <input type="text" class="form-control rounded-0  @error('web_site') is-invalid @else border-dark @enderror"
                               id="web_site" name="web_site" placeholder="https://" value="{{ $comment['web_site'] }}" autocomplete="off" >
                    </div>



                    <div class="form-group">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit"  class="btn btn-outline-dark">提交</button>
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </section>
    <style>

    </style>
@endsection
@section('script')
<script>


</script>

@endsection