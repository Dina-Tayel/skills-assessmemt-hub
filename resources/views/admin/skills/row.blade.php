<tr>
    <td>  </td>
    <td> {{ $skill->name('en') }} </td>
    <td>{{ $skill->name('ar') }} </td>
    <td>{{ $skill->category->name('en') }} </td>
    <td class="py-1"> <img src="{{ asset('uploads/skills/' . $skill->img) }}"
            alt="image">
    </td>
    <td>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <i class="mdi mdi-alarm-check" style="color:green"></i>Active
            </div>
      
    </td>

<td>
<button type="button" data-bs-toggle="modal" data-bs-target="#updateModal"
    class="btn btn-primary btn-icon-text edit-btn "><i
        class="mdi mdi-lead-pencil"></i></button>

<button type="button" class="btn btn-danger btn-icon-text delete-btn">
    <i class="mdi mdi-delete"></i>
</button>

</td>
</tr>