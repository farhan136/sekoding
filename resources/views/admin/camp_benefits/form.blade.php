@extends('layouts.form')

@section('title', "Create Camp's Benefit")

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
              <form id="quickform" action="{{url('/camp_benefits/store', $id)}}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Camp's Benefit</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Camp's Benefit" autocomplete="off" required value="{{ !empty($benefits)? $benefits->name : '' }}">
                  </div>
                  <div class="form-group">
                    <label>Camp's Name</label>
                    <select name="camps_id" class="form-control" autocomplete="off" required>
                      <option></option>
                      @foreach($camps as $camp)
                        <?php 
                          $selected = '';
                        if(!empty($benefits) && $camp->id == $benefits->id){
                          $selected = 'selected';
                        } ?>
                        <option value="{{$camp->id}}" {{$selected}}>{{$camp->title}}</option>
                      @endforeach  
                    </select>
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