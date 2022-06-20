@extends('admin.layout')
@section('title')
    show Exam
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card- text-center">All Exams</h4>
                @include('admin.inc.ajax-messages')
                <p class="card-description"> <a href="{{ url('dashboard/exams/create') }}" class="btn btn-outline-info btn-fw">Add New Exam</a>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Name(ar)</th>
                                <th> Name(en) </th>
                                <th> skill </th>
                                <th> Questions no </th>
                                <th>Active</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr id="{{ $exam->id }}">
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $exam->name('ar') }} </td>
                                    <td> {{ $exam->name('en') }} </td>
                                    <td> {{ $exam->skill->name('en') }} </td>
                                    <td> {{ $exam->questions_no }} </td>
                                    @if ($exam->active)
                                        <td>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <i class="mdi mdi-alarm-check" style="color:green"></i>Active
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <div class="col-sm-6 col-md-4 col-lg-8">
                                                <i class="mdi mdi-alarm-off" style="color: darkred"></i>off
                                            </div>
                                        </td>
                                    @endif
                                    <td><img src="{{ asset('uploads/exams/' . $exam->img) }}"></td>
                                    <td>
                                            <a href="{{ url("dashboard/exams/edit/$exam->id") }}" class="btn btn-primary btn-icon-text edit-btn "><i
                                                    class="mdi mdi-lead-pencil"></i></a>

                                        <button type="button" class="btn btn-danger btn-icon-text delete-btn" data-id="{{ $exam->id }}">
                                            <i class="mdi mdi-delete"></i>
                                        </button>

                                        <a href='{{ url("dashboard/exams/show/$exam->id") }}' class="btn btn-primary btn-icon-text"><i
                                                class="mdi mdi-eye"></i></a>
                                                <a href="{{ url("dashboard/exams/show-questions/$exam->id/questions") }}" class="btn btn-success btn-icon-text"><i class="mdi mdi-help"></i></a>
                                                
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $exams->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
    $('#success-msg').hide();
  $(document).on('click','.delete-btn',function(e){
    e.preventDefault();
    let id = $(this).attr('data-id');
    let route='{{ url('dashboard/exams/delete') }}';
    $.ajax({
        type:'delete',
        url:route,
        data:{
            'id':id,
             "_token":"{{ csrf_token() }}" ,
        },
        success:function(data){
            if(data.success){

                $('#success-msg').show()
                $('#success-msg').text(data.success)
                $('#'+data.id).remove()
            }
        }
    })
    
  })
</script>
    
@endsection