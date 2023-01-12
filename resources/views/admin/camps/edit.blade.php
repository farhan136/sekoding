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
              <h3 class="card-title">Edit Camp</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <form id="quickform" action="{{url('/camps/update/'.$camp->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Camp's Name</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Camp's Name" autocomplete="off" value="{{$camp->title}}">
                  </div>
                  <div class="form-group">
                    <label>Camp's Price</label>
                    <input type="number" name="price" value="{{$camp->price}}" class="form-control" placeholder="Enter Camp's Price" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Camp's Banner</label>
                    <input type="file" name="banner" class="form-control" autocomplete="off">
                    <input type="hidden" name="file_existing" value="{{$camp->banner}}">
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

@section('js')
<script type="text/javascript">
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
  });

</script>
@endsection