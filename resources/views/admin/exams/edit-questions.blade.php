@extends('admin.layout')
@section('title')
    Edit Question
@endsection
@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
          <h4 class="card-title">Edit Question</h4>
          <form class="form-sample" method="POST" action="{{ url("dashboard/exam/update-questions/$examId/$question->id") }}">
           @csrf
            @method('PUT')
          <p class="card-description"> Question  </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                  <input type="text" name="title" value="{{ $question->title }}" class="form-control"  >
                    @error('title')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                    
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Right Answer</label>
                <div class="col-sm-9">
                  <input type="number" name="right_ans" value="{{ $question->right_ans }}" class="form-control">
                  @error('right_ans')
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
                  <input type="text" name="option_1" value="{{ $question->option_1 }}" class="form-control">
                  @error('option_1')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option2</label>
                <div class="col-sm-9">
                  <input type="text" name="option_2" value="{{ $question->option_2 }}" class="form-control">
                  @error('option_2')
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
                  <input type="text" name="option_3" value="{{ $question->option_3 }}" class="form-control">
                  @error('option_3')
                  <p class="tex-danger" style="color: red">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">option4</label>
                <div class="col-sm-9">
                    <input type="text" name="option_4" value="{{ $question->option_4 }}" class="form-control">
                    @error('option_4')
                    <p class="tex-danger" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
              </div>
            </div>
          </div>

        <div>
            <button class="btn btn-primary btn-fw">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection