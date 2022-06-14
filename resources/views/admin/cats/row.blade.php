<tr id="{{ $cat->id }}">
    <td> {{ $cat->id }} </td>
    <td> {{ $cat->name('en') }} </td>
    <td> {{ $cat->name('ar') }} </td>
    <td>
        @if ($cat->active)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <i class="mdi mdi-alarm-check" style="color:green"></i>Active
            </div>
        @else
            <div class="col-sm-6 col-md-4 col-lg-8">
                <i class="mdi mdi-alarm-off" style="color: darkred"></i>off
            </div>
        @endif
    </td>
    <td>
        <a href="#" class="btn btn-primary btn-icon-text "><i
                class="mdi mdi-lead-pencil"></i></a>
        <a href="#" class="btn btn-danger btn-icon-text"><i class="mdi mdi-delete"></i></a>
        <a href="#" class="btn btn-success btn-icon-text"><i class="mdi mdi-eye"></i></a>
    </td>
</tr>