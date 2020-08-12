<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-7">
        <div class="card card-default">
            <div class="card-header border-bottom-0">

                <div class="float-right">
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="#" class="btn btn-sm btn-success" title="{{ __('Add') }}">
                            <i class="fa fa-plus"></i><span class="">&nbsp;&nbsp;{{ __('Add') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover grid-table">
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

            </div>

            <div class="card-footer">
                {!! $data->links() !!}
            </div>

        </div>

    </div>
    <div class="col-lg-5 col-md-5 col-sm-5">

        <div class="card card-default">
            <div class="card-header border-bottom-0">
                <h3 class="card-title">{{ __('Created Article') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ admin_url('category') }}" autocomplete="off" class="form-horizontal" pjax-container>
                @csrf

                <div class="card-body">
                    <div class="col-md-12">


                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Name') }}" value="" required />
                                @if ($errors->has('name'))
                                    <span id="name-error" class="error text-danger" >{{ $errors->first('name') }}</span>
                                @endif
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
    </div>
</div>