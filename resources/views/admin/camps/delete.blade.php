@extends('layouts.form')

@section('title', 'Edit Class')

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
              <h3 class="card-title">Are You Sure?</h3>
            </div>
            <div class="card-body p-0">
              <form action="{{url('/camps/delete/'.$camp->id)}}" method="post">
                @csrf
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
