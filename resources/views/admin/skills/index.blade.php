@extends('admin.layout')
@section('title')
    Category Skills
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Skills</h4>
                <button type="button" class="btn btn-inverse-primary btn-fw mb-3" data-bs-toggle="modal"
                    data-bs-target="#addskillModal">Add New Skill</button>

                @include('admin.inc.ajax-messages')
                @include('admin.inc.messages')
                <!-----------    Add Skill Modal---------->
                <div class="modal fade" id="addskillModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Add Skill</h4>
                                        <form method="" action="" class="forms-sample" id="addskill-form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="examplecategoryname1"
                                                    class="col-sm-3 col-form-label">Name(en)</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name_en" class="form-control"
                                                        id="examplecategoryname1" placeholder="Name in english">

                                                    <p id="name_en_error1" class="text-danger"> </p>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="examplecategoryname2"
                                                    class="col-sm-3 col-form-label">Name(ar)</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name_ar" class="form-control"
                                                        id="examplecategoryname2" placeholder="Name in arabic">

                                                    <p id="name_ar_error1" class="text-danger"></p>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Upload skill image</label>
                                                <input class="form-control" type="file" name="img" id="img">
                                                <p id="img_error1" class="text-danger"></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category_id" id="cat_id"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    style="width:100%" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option value=""> --- Please Select --- </option>
                                                    @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name('en') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p id="category_id_error1" class="text-danger"></p>
                                                <span
                                                    class="select2 select2-container
                                                 select2-container--default select2-container--focus"
                                                    dir="ltr" data-select2-id="2" style="width: 100%;">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--- end  Add New category modal body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="form-btn" type="submit" form="addskill-form"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------  End Add Skill Modal------>
                <!-----------    Edit Skill Modal---------->
                <div class="modal fade" id="editskillModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Skill</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Update Skill</h4>
                                        <form method="post" action="{{ url('dashboard/skills/update') }}" class="forms-sample" id="editskill-form"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="id" name="id">
                                            <div class="form-group row">
                                                <label for="examplecategoryname1"
                                                    class="col-sm-3 col-form-label">Name(en)</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name_en" class="form-control" id="name_en"
                                                        placeholder="Name in english">

                                                    <p id="name_en_error" class="text-danger"> </p>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="examplecategoryname2"
                                                    class="col-sm-3 col-form-label">Name(ar)</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="name_ar" class="form-control" id="name_ar"
                                                        placeholder="Name in arabic">

                                                    <p id="name_ar_error" class="text-danger"></p>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Upload skill image</label>
                                                <input class="form-control" type="file" name="img" id="formFile">
                                                <p id="img_error" class="text-danger"></p>
                                                <img src="" id="target">

                                                <div id="insertedImages">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Category</label>
                                                <select id="edit-select" name="category_id"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    style="width:100%" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                    <option value="" disabled selected> --- Please Select --- </option>

                                                    @foreach ($cats as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name('en') }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p id="category_id_error" class="text-danger"></p>
                                                <span
                                                    class="select2 select2-container
select2-container--default select2-container--focus"
                                                    dir="ltr" data-select2-id="2" style="width: 100%;">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--- end  Edit skill modal body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="submit-update-modal" type="submit" form="editskill-form"
                                    class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------  End Edit Skill Modal------>

                <!---------      Table   -------->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>name(en)</th>
                                <th> name(ar) </th>
                                <th> category </th>
                                <th> image </th>
                                <th>Activity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-data">
                            @foreach ($skills as $skill)
                                <tr class="skill{{ $skill->id }}">
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $skill->name('en') }} </td>
                                    <td>{{ $skill->name('ar') }} </td>
                                    <td>{{ $skill->category->name('en') }} </td>
                                    <td class="py-1"> <img src="{{ asset('uploads/skills/' . $skill->img) }}"
                                            alt="image">
                                    </td>
                                    <td>
                                        @if ($skill->active)
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <i class="mdi mdi-alarm-check" style="color:green"></i>Active
                                            </div>
                                        @else
                                    </td>
                                    <div class="col-sm-6 col-md-4 col-lg-8">
                                        <i class="mdi mdi-alarm-off" style="color: darkred"></i>off
                                    </div>
                            @endif
                            <td>
                                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#editskillModal"
                                    class="btn btn-primary btn-icon-text edit-btn " data-id="{{ $skill->id }}"><i
                                        class="mdi mdi-lead-pencil"></i></button> --}}
                                          <button type="button" data-bs-toggle="modal" data-bs-target="#editskillModal"
                                    class="btn btn-primary btn-icon-text edit-btn " data-id="{{ $skill->id }}"
                                     data-name-ar="{{ $skill->name('ar') }}" data-name-en="{{ $skill->name('en') }}"
                                     data-img="{{ $skill->img }}" data-cat-id="{{ $skill->category_id }}"><i
                                        class="mdi mdi-lead-pencil"></i></button>

                                <button type="button" class="btn btn-danger btn-icon-text delete-btn"
                                    data-id="{{ $skill->id }}">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!------------   End Table------>
            </div>
            <div class="d-flex m-3 justify-content-center">
                {{ $skills->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ////////////////// store skills in database //////////////////////
        $('#success-msg').hide();
        $('#form-btn').click(function(e) {
            $('#name_en_error1').text('')
            $('#name_ar_error1').text('')
            $('#img_error1').text('')
            $('#category_id_error1').text('')
            e.preventDefault();
            var formData=new FormData($('#addskill-form')[0]);
            formData.append('img', $('#img')[0].files[0]);
            $.ajax({
                type: 'post',
                url: '{{ url('dashboard/skills/store') }}',
                data: formData,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function(databack) {
                    $('.tbody-data').prepend(databack)
                    $('#addskillModal').modal('hide')
                },
                error: function(xhr, status, error) {
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#' + key + '_error1').text(value[0]);
                    })
                }
            })
        });

        //////////////////   delete skill ///////////////////////////
        $('#success-msg').hide();
        $(document).on('click', '.delete-btn', function(e) {

            e.preventDefault();
            let id = $(this).attr('data-id');
            $.ajax({
                type: 'delete',
                url: '{{ url('dashboard/skills/delete') }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id
                },
                success: function(data) {
                    $('#success-msg').show();
                    $('#success-msg').text(data.success);
                    $('.skill' + data.id).remove();
                }

            })
        });



        $('.edit-btn').click(function(e){
            e.preventDefault();
            let id= $(this).attr('data-id');
            let name_ar = $(this).attr('data-name-ar');
            let name_en=$(this).attr('data-name-en');
            let img= $(this).attr('data-img');
            let cat_id=$(this).attr('data-cat-id');
            $('#id').val(id);
            $('#name_ar').val(name_ar);
            $('#name_en').val(name_en);
            $('#edit-select').val(cat_id);
            $("#insertedImages").html('<img src="{{ asset('uploads/skills/') }}/' + $(this).attr('data-img') +
                '" width="100" height="100" id="insertedImages">');
                console.log(img);
        });


        /////////////////  edit skill ///// //////////////////////

        // $(document).on('click', '.edit-btn', function(e) {
        //     e.preventDefault();
        //     let id = $(this).attr('data-id');
        //     let route = '{{ url('dashboard/skills/edit') }}';
        //     // console.log(route);
        //     $.ajax({
        //         type: 'get',
        //         url: route,
        //         // dataType:'JSON',
        //         data: {
        //             '_token': "{{ csrf_token() }}",
        //             'id': id,
        //         },
        //         success: function(data) {
        //             // console.log(option[value='cat_id']);
        //             let cat_id = data.category_id;
        //             // console.log(cat_id);
        //             let name = JSON.parse(data.name);
        //             let image = '<img src="{{ asset('uploads/skills/') }}/' + data.img +
        //                 '" width="100" height="100" id="insertedImages">';
        //             $('#name_ar').val(name.ar)
        //             $('#name_en').val(name.en)
        //             $("#insertedImages").html(image);
        //             $('#edit-select').val(cat_id);
        //         }
        //     })

        // });
        
        // /////////////////  update skill ///// //////////////////////
        // $('#submit-update-modal').click(function(e) {
        //     e.preventDefault;

        //     // var formData = $('#editskill-form').serialize();
        //     var formData=new FormData($('#editskill-form')[0]);
        //     formData.append('img', $('#img')[0].files[0]);
        //     let route = '{{ url('dashboard/skills/update') }}';
        //     $.ajax({
        //         type: 'post',
        //         url: route,
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(data) {
        //             // console.log(data)
        //             $('#success-msg').show()
        //             $('#success-msg').text("data is updated successfully !")
        //             $('#' + id).html(data)
        //             $('#editskillModal').modal('hide')

        //         },
        //         error: function(xhr, status, error) {
        //             $.each(xhr.responseJSON.errors, function(key, value) {
        //                 $('#' + key + '_error').text(value[0]);
        //             })
        //         }
        //     })
        // })
    </script>
@endsection
