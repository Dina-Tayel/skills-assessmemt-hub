@extends('admin.layout')
@section('title')
    Users Messages
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card- text-center">{{ $message->name }} Message </h4>
                <p class="card-description"> Show Message</a>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th> Name</th>
                                <td> {{ $message->name }} </td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> {{ $message->email }} </td>
                            </tr>
                            <tr>
                                <th> subject</th>
                                <td>{{ $message->subject ?? '---' }}</td>
                            </tr>
                            <tr>
                                <th> body</th>
                                <td>{{ $message->body }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card- text-center"> Send Response </h4>
                <form method="POST" action="{{ url("dashboard/messages/response/$message->id") }}" class="forms-sample"
                    id="add-form">
                    @csrf
                    <div class="form-group row">
                        <label for="exampletitle1" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="examplecategoryname1"
                                placeholder="title">

                            @error('title')
                                <p id="title" class="text-danger"> {{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="examplebody1" class="col-sm-3 col-form-label">Body</label>
                        <div class="col-sm-9">
                            <input type="text" name="body" value="{{ old('body') }}" class="form-control" id="examplecategoryname2"
                                placeholder="body">
                            @error('body')
                                <p id="body" class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-inverse-primary btn-fw mb-3" type="submit">Submit</button>
                </form>


            </div>
        </div>
    </div>
@endsection
