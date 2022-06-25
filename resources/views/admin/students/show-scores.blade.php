@extends('admin.layout')
@section('title')
    Show Student-scores
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card- text-center">All Students</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Exam</th>
                                <th> Score</th>
                                <th> Time(mins)</th>
                                <th> At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $exam->name('en') }} </td>
                                    <td> {{ $exam->pivot->score }} </td>
                                    <td> {{ $exam->pivot->max_time }} </td>
                                    <td> {{ $exam->pivot->created_at }} </td>
                                    <td> {{ $exam->pivot->status }} </td>
                                    <td class="d-flex justify-content-center">
                                        @if ($exam->pivot->status == "closed")
                                        <div class="col-sm-6 col-md-4 col-lg-3" >
                                           <a href="{{ url("dashboard/students/open-exam/$student->id/$exam->id") }}"> <i class="mdi mdi-lock" style="color: darkred"></i> </a>
                                          </div>
                                        @else
                                        <div class="col-sm-6 col-md-4 col-lg-3">
                                           <a href="{{ url("dashboard/students/close-exam/$student->id/$exam->id") }}"> <i class="mdi mdi-lock-open-outline" style="color: blue"></i></a>
                                          </div>
                                        @endif
                                    </td>
                                    {{-- <td class="d-flex justify-content-center">
                                       <a href="{{ url("dashboard/students/show-scores/$exam->id") }}"> <i class="mdi mdi-wrench" style="color: blue" width="50px"></i></a>
                                    </td>  --}}
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
