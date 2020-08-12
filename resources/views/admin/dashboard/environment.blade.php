<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Environment</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover text-nowrap">

                @foreach($envs as $env)
                    <tr>
                        <td width="120px">{{ $env['name'] }}</td>
                        <td>{{ $env['value'] }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>