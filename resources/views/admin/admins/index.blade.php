@extends('admin.layout')
@section('title')
    Admins
@endsection
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card- text-center">All Admins</h4>
                <a href="{{ url("dashboard/admins/create-new-admin") }}" class="btn btn-inverse-primary btn-fw mb-3">Add New Admin</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Role</th>
                            <th> Verified</th>
                            <th> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td> {{ $admin->name }} </td>
                                <td> {{ $admin->email }} </td>
                                <td>{{ $admin->role->name }}</td>
                                <td>
                                    @if ($admin->email_verified_at !== null)
                                        <span class="badge rounded-pill text-bg-primary">Yes</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    @if ($admin->role->name == 'admin')      
                                    <form method="POST" action="{{ url("dashboard/admins/promote/$admin->id") }}" id="form-promote">
                                        @csrf
                                        <button type="submit" class="btn btn-inverse-primary m-3" > <i class="mdi mdi-arrow-up-bold" style="color: darkred" ></i> </button>
                                    </form>
                                    @else
                                    <form method="POST" action="{{ url("dashboard/admins/demote/$admin->id") }}" id="form-promote">
                                        @csrf
                                        <button type="submit" class="btn btn-inverse-danger btn-icon-text  m-3"> 
                                            <i class="mdi mdi-arrow-bottom-right" style="color: blue"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form method="POST" action="{{ url("dashboard/admins/delete/$admin->id") }}" id="form-promote">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-icon-text delete-btn m-3"  >
                                            <i class="mdi mdi-delete"></i> 
                                          </button>
                                    </form>
                                </td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection