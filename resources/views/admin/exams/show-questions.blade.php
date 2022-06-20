@extends('admin.layout')
@section('title')
    Exam Qustions
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card- text-center">Exam Qustions</h4>
                <p class="card-description"> <a href="{{ url('dashboard/exams/create') }}"
                        class="btn btn-outline-info btn-fw">Add New Exam</a>
                </p>
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Exam</th>
                                <th>options </th>
                                <th>right answer </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr id="{{ $question->id }}">
                                    <td>{{ $question->title }}</td>
                                    <td> {{ $question->exam->name('en') }} </td>
                                    <td> {{ $question->option_1 }} | <br>
                                        {{ $question->option_2 }} | <br>
                                        {{ $question->option_3 }} | <br>
                                        {{ $question->option_4 }} | <br>
                                    </td>
                                    <td>{{ $question->right_ans }}</td>
                                    <td>
                                        <a href="{{ url("dashboard/exams/edit-questions/$exam->id/$question->id") }}"
                                            class="btn btn-primary btn-icon-text edit-btn "><i class="mdi mdi-lead-pencil"></i></a>
                                    </td>
                            @endforeach

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div>
        <a href="{{ url('dashboard/exams') }}" class="btn btn-primary btn-fw">Back To All Exams</a>
        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-fw">Back</a>
    </div>
@endsection
