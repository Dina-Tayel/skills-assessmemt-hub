@extends('admin.layout')
@section('title')
    Students
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
                                <th> Name</th>
                                <th> Email</th>
                                <th> Verified At</th>
                                <th> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td> {{ $student->id }}</td>
                                    <td> {{ $student->name }} </td>
                                    <td> {{ $student->email }} </td>
                                    <td>
                                        @if ($student->email_verified_at !== null)
                                            <span class="badge rounded-pill text-bg-primary">Yes</span>
                                        @else
                                            <span class="badge rounded-pill text-bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                       <a href="{{ url("dashboard/students/show-scores/$student->id") }}"> <i class="mdi mdi-wrench" style="color: blue" width="50px"></i></a>
                                    </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $students->links() }}
    </div>
@endsection
