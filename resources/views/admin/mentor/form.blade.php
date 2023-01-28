@extends('layouts.form')

@section('title', "Create Mentor")

@section('css')
<style>
    .content-wrapper {background-color:#454D55 !important;}
    .card{
      margin-top: 40px;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/mentor/store', $id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Mentor's Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Mentor's Name" autocomplete="off" required value="{{ !empty($mentors)? $mentors->name : '' }}">
                  </div>
                  <div class="form-group">
                    <label>Mentor's Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Mentor's Name" autocomplete="off" required value="{{ !empty($mentors)? $mentors->email : '' }}">
                  </div>
                  <div class="form-group">
                    <label>Mentor's Photo</label>
                    <input type="file" name="photo" {{ !empty($mentors)? '' : 'required' }} class="form-control" autocomplete="off">
                    <input type="hidden" name="file_existing" value="{{ !empty($mentors)? $mentors->photo : '' }}">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection