<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Dependencies</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-hover text-nowrap ">

            @foreach($dependencies as $dependency => $version)
                <tr>
                    <td width="240px">{{ $dependency }}</td>
                    <td><span class="label label-primary">{{ $version }}</span></td>
                </tr>
            @endforeach
        </table>
    </div>
    <!-- /.card-body -->
</div>