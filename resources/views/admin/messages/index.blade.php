@extends('admin.layout')
@section('title')
    Users Messages
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card- text-center">All Messages</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> subject</th>
                            <th> Show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td> {{ $message->name }} </td>
                                <td> {{ $message->email }} </td>
                                <td>{{ $message->subject ?? "---" }}</td>
                                <td>
                                    <a href="{{ url("dashboard/messages/show-message/$message->id") }}"  class="btn btn-success btn-icon-text"><i class="mdi mdi-eye"></i></a>                             
                                 </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex m-3 justify-content-center">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection