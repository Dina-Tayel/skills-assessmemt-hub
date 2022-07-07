@extends('admin.layout')
@section('title')
    Create Questions
@endsection
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <h4 class="card-title">Insert Questions</h4>
          <form class="form-sample" method="POST" action="{{ route("exam-questions.store",$examId) }}">
           @csrf
            @for ($i=1 ; $i <= $questions_no ; $i++) 
          <p class="card-description"> Question {{ $i }} </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" name="title[]" class="form-control">
                  {{-- @error('titles[]')
                     <p class="tex t-danger">{{ $message }}</p>
                    @enderror --}}
                    @error('title.*')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                    
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Right Answer</label>
                <div class="col-sm-9">
                  <input type="number" name="right_ans[]" class="form-control">
                  @error('right_ans.*')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option1</label>
                <div class="col-sm-9">
                  <input type="text" name="option_1[]" class="form-control">
                  @error('option_1.*')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option2</label>
                <div class="col-sm-9">
                  <input type="text" name="option_2[]" class="form-control">
                  @error('option_2.*')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option3</label>
                <div class="col-sm-9">
                  <input type="text" name="option_3[]"  class="form-control">
                  @error('option_3.*')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option4</label>
                <div class="col-sm-9">
                    <input type="text" name="option_4[]" class="form-control">
                    @error('option_4.*')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
              </div>
            </div>
          </div>
        @endfor
        <div>
            <button class="btn btn-primary btn-fw">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection