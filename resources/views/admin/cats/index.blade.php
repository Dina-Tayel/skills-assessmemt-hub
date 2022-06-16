@extends('admin.layout')
@section('title')
    All Categories
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">All Categories</h4>

                @include('admin.inc.ajax-messages')
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-fw m-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Add New Category</button>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!--- Add New category modal body -->
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Add Category</h4>             
                                      <form method="" action="" class="forms-sample" id="add-form">
                                        @csrf
                                        <div class="form-group row">
                                          <label for="examplecategoryname1" class="col-sm-3 col-form-label">Name(en)</label>
                                          <div class="col-sm-9">
                                            <input  type="text" name="name_en" class="form-control" id="examplecategoryname1" placeholder="Name in english">
                                            
                                                <p id="name_en_error" class="text-danger"> </p>
                                          
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label for="examplecategoryname2" class="col-sm-3 col-form-label">Name(ar)</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="name_ar" class="form-control" id="examplecategoryname2" placeholder="Name in arabic">
                                            
                                            <p id="name_ar_error" class="text-danger"></p>
                                       
                                        </div>
                                        </div>
  
                                      </form>
                                    </div>
                                  </div>
                            </div>
                            <!--- end  Add New category modal body -->
                            <div class="modal-footer">
                                <button type="button"class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="form-btn" type="submit"  form="add-form" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">update Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
            
                                        <!---Update category modal body -->
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                  <h4 class="card-title">Update Category</h4>             
                                                  <form method="" action="" class="forms-sample" id="update-form">
                                                    @csrf
                                                    <input type="hidden" name="id" id="edit-form-id">
                                                    <div class="form-group row">
                                                      <label for="examplecategoryname1" class="col-sm-3 col-form-label">Name(en)</label>
                                                      <div class="col-sm-9">
                                                        <input  type="text" id="edit-form-name-en" name="name_en" class="form-control" id="examplecategoryname1" placeholder="Name in english">
                                                        
                                                            <p id="name_en_error1" class="text-danger"> </p>
                                                      
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="examplecategoryname2" class="col-sm-3 col-form-label">Name(ar)</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" id="edit-form-name-ar" name="name_ar" class="form-control" id="examplecategoryname2" placeholder="Name in arabic">
                                                        
                                                        <p id="name_ar_error1" class="text-danger"></p>
                                                   
                                                    </div>
                                                    </div>
              
                                                  </form>
                                                </div>
                                              </div>
                                        </div>
                                        <!--- end Update category modal body -->
                                        <div class="modal-footer">
                                            <button type="button"class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="submit-update-modal"  form="update-form" class="btn btn-primary">update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> id </th>
                                <th> Name (en)</th>
                                <th> Name(ar) </th>
                                <th> Active </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody class="tbody-data">
                            @foreach ($cats as $index => $cat)
                                <tr id="{{ $cat->id }}">
                                    {{-- <td> {{ $loop->iteration }} </td> --}}
                                    <td> {{ $cat->id }} </td>
                                    <td > {{ $cat->name('en') }} </td>
                                    <td > {{ $cat->name('ar') }} </td>
                                    <td>
                                        @if ($cat->active)
                                            {{-- <span class="badge badge-primary">Active</span> --}}
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <i class="mdi mdi-alarm-check" style="color:green"></i>Active
                                            </div>
                                        @else
                                            {{-- <span class="badge badge-danger">Inactive</span> --}}
                                            <div class="col-sm-6 col-md-4 col-lg-8">
                                                <i class="mdi mdi-alarm-off" style="color: darkred"></i>off
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-dark btn-icon-text"> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                          </button> --}}
                                        <button type="button" data-bs-toggle="modal" data-id="{{ $cat->id }}"
                                             cat-name-en={{ $cat->name('en') }} cat-name-ar={{ $cat->name('ar') }}
                                        data-bs-target="#updateModal" class="btn btn-primary btn-icon-text edit-btn "><i
                                                class="mdi mdi-lead-pencil"></i></button>

                                        <button type="button" class="btn btn-danger btn-icon-text delete-btn" data-url="{{url('dashboard/categories/delete/'.$cat->id) }}" data-id="{{ $cat->id }}" >
                                            <i class="mdi mdi-delete"></i> 
                                          </button>

                                        <a href="#" class="btn btn-success btn-icon-text"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex m-3 justify-content-center">
                {{ $cats->links() }}
            </div>
        </div>
    </div>

@endsection

@section('scripts')

{{-- store cat in database --}}
<script>
    $('#success-msg').hide()
    $('#form-btn').click(function(e){
        e.preventDefault();
        let formData=$('#add-form').serialize();
        $.ajax({
            type:'post',
            url:'{{ url('dashboard/categories/store') }}',
            data:formData,
            success:function(data){
                // console.log(data)
                $('.tbody-data').prepend(data)
                $('#exampleModal').modal('hide')
            },error:function(xhr,status,error)
                {
                   $.each(xhr.responseJSON.errors,function(key,value){
                       $('#' + key + '_error'). text(value[0]);
                   })
                }
        })
    })
</script>

{{-- delete cat from database --}}
<script>
    $(document).on("click",".delete-btn",function(e){
        e.preventDefault();
        let id=$(this).attr('data-id')
        let route=$(this).attr('data-url') 
        // alert(id)
        $.ajax({
            type:"delete",
            url:route,
            data:{
                "_token":"{{ csrf_token() }}"
            },
            success:function(data){
            //    console.log(data)
                alert(data.success);
                $('#'+data.id).remove();
            }

        })

    })
</script>

{{-- update category --}}
<script>
     $('#success-msg').hide()
    $('.edit-btn').click(function(e){
        e.preventDefault();
        let id=$(this).attr('data-id')
        let NameEn=$(this).attr('cat-name-en')
        let Namear=$(this).attr('cat-name-ar')
        // console.log(NameEn);
        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(NameEn)
        $('#edit-form-name-ar').val(Namear)
       
    });
    $('#success-msg').hide()
    $('#submit-update-modal').click(function(e){
       
        e.preventDefault(e);
        let formData=$('#update-form').serialize();
        let id = $('#edit-form-id').val();
        // alert (formData);
        $.ajax({
            type:'post',
            url:'{{ url('dashboard/categories/update') }}',
            data:formData,
            success:function(data){
                $('#success-msg').show()
                 $('#success-msg').text("data is updated successfully !");
                $('#'+id).html(data)
                $('#updateModal').modal('hide')

            },error:function(xhr,status,error)
                {
                   $.each(xhr.responseJSON.errors,function(key,value){
                       $('#' + key + '_error1'). text(value[0]);
                   })
                }
        })
    })
           
</script>
 
@endsection
