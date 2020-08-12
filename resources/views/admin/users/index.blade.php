<div class="card card-default">
    <div class="card-header  border-bottom-0">

        <div class="float-right">
            <div class="btn-group pull-right" style="margin-right: 10px">
                <a href="#" class="btn btn-sm btn-success" title="{{ __('Add') }}">
                    <i class="fa fa-plus"></i><span class="">&nbsp;&nbsp;{{ __('Add') }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body  p-0">

        <div class="table-responsive">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Avatar') }}</th>
                    <th>{{ __('Created At') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $k=>$v)
                    <tr>
                        <td>{{ $v['name'] }}</td>
                        <td>
                            {{ $v['email'] }}
                        </td>

                        <td>
                            <img style="width: 25px" src="{{ $v['avatar'] }}">
                        </td>

                        <td>
                            {{ $v['created_at'] }}
                        </td>
                        <td class="td-actions">
                            <a class="btn btn-success btn-sm" href="{{ route('admin.user.edit',['user'=>$v['id']]) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
        <div class="card-footer">
            {{$data->links()}}
        </div>
    </div>

</div>