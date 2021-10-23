<div class="card card-default">
    <div class="card-header p-0">
{{--        <h3 class="card-title p-3">设置</h3>--}}
        <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link   active text-sm" href="#tab_1" data-toggle="tab">基本配置</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">邮件配置</a></li>
{{--            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tab 3</a></li>--}}
        </ul>
    </div><!-- /.card-header -->
    <form method="post" id="quickForm" action="{{ route('admin.config.store') }}" autocomplete="off" class="form-horizontal" pjax-container >

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


                    @csrf
                <div class="col-md-12">

                    <div class="form-group row">
                        <label for="input-name" class="col-sm-2 col-form-label">站点名称</label>
                        <div class="col-sm-10">
                            <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="站点名称" value="" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-uri" class="col-sm-2 col-form-label">站点地址</label>
                        <div class="col-sm-10">
                            <input class="form-control " name="uri" id="input-uri" type="text" placeholder="站点地址" value="" required />

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-introduction" class="col-sm-2 col-form-label">站点简介</label>
                        <div class="col-sm-10">
                            <textarea rows="5" class="form-control " name="introduction" id="input-introduction"  placeholder="站点简介"  ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                <div class="col-md-12">

                    <div class="form-group row">
                        <label for="input-MAIL_MAILER" class="col-sm-2 col-form-label">MAIL_MAILER</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="MAIL_MAILER" id="input-MAIL_MAILER" type="text" placeholder="MAIL_MAILER" value="" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-MAIL_HOST" class="col-sm-2 col-form-label">MAIL_HOST</label>
                        <div class="col-sm-10">
                            <input class="form-control " name="MAIL_HOST" id="input-MAIL_HOST" type="text" placeholder="MAIL_HOST" value="" required />

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-MAIL_PORT" class="col-sm-2 col-form-label">MAIL_PORT</label>
                        <div class="col-sm-10">
                            <input class="form-control " name="MAIL_PORT" id="input-MAIL_PORT" type="text" placeholder="MAIL_PORT" value="" required />

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="input-MAIL_USERNAME" class="col-sm-2 col-form-label">MAIL_USERNAME</label>
                        <div class="col-sm-10">
                            <input class="form-control " name="MAIL_USERNAME" id="input-MAIL_USERNAME" type="text" placeholder="MAIL_USERNAME" value="" required />

                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="input-MAIL_PASSWORD" class="col-sm-2 col-form-label">MAIL_PASSWORD</label>
                        <div class="col-sm-10">
                            <input class="form-control " name="MAIL_PASSWORD" id="input-MAIL_PASSWORD" type="text" placeholder="MAIL_PASSWORD" value="" required />

                        </div>
                    </div>

                </div>

            </div>
{{--            <!-- /.tab-pane -->--}}
{{--            <div class="tab-pane" id="tab_3">--}}
{{--                --}}

{{--            </div>--}}
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </form>

    <div class="card-footer text-center">

        <button type="submit" class="btn btn-default">{{ __('Save') }} </button>
    </div>

</div>
<!-- ./card -->
