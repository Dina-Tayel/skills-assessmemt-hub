@extends('admin.layout')
@section('title')
    Create New Admin
@endsection
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add New Admin</h4>
        <form class="form-sample" method="POST" action="{{ url("dashboard/admins/store-admin") }}">
            @csrf
          <p class="card-description"> Personal info </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label"> Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                  @error('name')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                  @error('email')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label"> confirm Password</label>
                  <div class="col-sm-9">
                      <input type="password" name="password_confirmation" class="form-control">
                      @error('password_confirmation')
                      <p class="tex-danger" style="color: red">{{ $message }}</p>
                      @enderror
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Admin Role</label>
                <div class="col-sm-9">
                  <select name="role_id" class="form-control">
                    <option value="" selected disabled>-------please select------</option>
                    @foreach ($adminRoles as $role )      
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : ''  }}>{{ $role->name }}</option>
                    @endforeach
                  </select>
                  @error('role_id')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-inverse-primary btn-fw mb-3" type="submit" >Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection