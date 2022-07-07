@extends('admin.layout')

@section('title')
    Show {{ $exam->name('en') }} Exam
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{ $exam->name('en') }} Exam</h4>
        <p class="card-description"> <a class="text-decoration-none" href="{{ url('dashboard/home') }}">Home</a>  <code>/</code>
            <code> <a class="text-decoration-none" href="{{ route('exam.index') }}">Exams </a> </code>
        </p>
        <div class="table-responsive">
          <table class="table">
            <tbody>
                <tr>
                  <th>Name(en)</th>
                  <td>
                   {{ $exam->name('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Name(ar)</th>
                  <td>
                   {{ $exam->name('ar') }}
                  </td>
                </tr>
                <tr>
                  <th>skill</th>
                  <td>
                   {{ $exam->skill->name('en') }}
                  </td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>
                   {{ $exam->desc('en') }}
                  </td>
                </tr>
                <tr>
                  <th>questions_no </th>
                      <td>{{ $exam->questions_no }}</td>
                </tr>
                <tr>
                <th>Active </th>
                <td>{{ $exam->active }}</td>
               </tr>
               <tr>
                <th>Difficulty </th>
                <td>{{ $exam->difficulty }}</td>
               </tr>
               <tr>
                <th>Difficulty </th>
                <td>{{ $exam->duration_mins }}</td>
               </tr>
               <tr>
                <th>Image</th>
                <td><img src="{{ asset('uploads/exams/'.$exam->img) }}" width="50px" height="50px"></td>
             </tr>
              </tbody>
          </table>
        </div>
    </div>
</div>
</div>
<div>
    <a href="{{ url("dashboard/exams/show/$exam->id/questions") }}" class="btn btn-primary btn-fw">Show Questions</a>
<a href="{{ url()->previous() }}" class="btn btn-secondary btn-fw">Back</a>

</div>


  {{-- <div class="card">
    <div class="card-header">
      <h3 class="card-title">Condensed Full Width Table</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-md">
        <tbody>
          <tr>
            <th>Name(en)</th>
            <td>
             {{ $exam->name('en') }}
            </td>
          </tr>
          <tr>
            <th>Name(ar)</th>
            <td>
             {{ $exam->name('ar') }}
            </td>
          </tr>
          <tr>
            <th>skill</th>
            <td>
             {{ $exam->skill->name('en') }}
            </td>
          </tr>
          <tr>
            <th>Description</th>
            <td>
             {{ $exam->desc('en') }}
            </td>
          </tr>
          <tr>
            <th>questions_no </th>
                <td>{{ $exam->questions_no }}</td>
          </tr>
          <tr>
          <th>Active </th>
          <td>{{ $exam->active }}</td>
         </tr>
         <tr>
            <th>Image</th>
            <td><img src="{{ asset('uploads/exams/'.$exam->img) }}" width="50px" height="50px"></td>
         </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div> --}}
@endsection