@extends('admin.layout')
@section('title')
Edit Exam
@endsection

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Exam</h4>
                <form class="form-sample" method="POST" action="{{ url("dashboard/exams/update/$exam->id") }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p class="card-description"> @include('admin.inc.messages') </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Name(en)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_en" value="{{ $exam->name('en') }}" class="form-control">
                                    @error('name_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> Name(ar)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name_ar" value="{{ $exam->name('ar') }}" class="form-control">
                                    @error('name_ar')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="col-sm-3 col-form-label"> Descriprion(en)</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="desc_en" rows="5">{{ $exam->desc('en') }}</textarea>
                                @error('desc_en')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-3 col-form-label"> Descriprion(ar)</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="desc_ar"  rows="5"> {{ $exam->desc('ar') }}</textarea>
                            @error('desc_ar')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="formFile" class="form-label">Upload skill image</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="file" name="img" id="img">
                                    <img src="{{ asset('uploads/exams/'.$exam->img) }}" width="50px" height="50px">
                                    @error('img')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Skill</label>
                                <div class="col-sm-9">
                                    <select name="skill_id"  class="js-example-basic-single select2-hidden-accessible"
                            style="width:100%" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option value=""> --- Please Select --- </option>
                            @foreach ($skills  as  $skill )
                           <option value="{{$skill->id}}" @if ($exam->skill_id  == $skill->id) selected @endif > {{$skill->name('en')}} </option>
                            @endforeach
                        </select>
                        @error('skill_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror 
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Questions no.</label>
                                <div class="col-sm-9">
                                    <input type="number" name="questions_no" value="{{ $exam->questions_no }}" class="form-control" >
                                    @error('questions_no')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Difficulty</label>
                                <div class="col-sm-9">
                                    <input type="number" name="difficulty" value="{{ $exam->difficulty }}" class="form-control" >
                                    @error('difficulty')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Duration</label>
                                <div class="col-sm-9">
                                    <input type="number" name="duration_mins" value="{{ $exam->duration_mins }}" class="form-control" > 
                                    @error('duration_mins')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror 
                                </div>
                            </div>
                        </div>
               
                    </div>
                    <div>
                        <button class="btn btn-primary btn-fw">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-fw">Back</a>
                        </div>

                </form>
            </div>
        </div>
    </div>

@endsection

