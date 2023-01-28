@extends('layouts.app')

@section('title', 'Master Camp Sekoding')

@section('css')
<style type="text/css">
  .center-align{
    text-align: center;
  }
</style>  
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Mentor List</h5>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body bg-light">
        <div class="row">
          <button type="button" class="btn btn-success" id="add">Add</button>
          <div class="col-md-12">
            <table id="table_mentors" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Email</th>
                  <th style="text-align: center;">Photo</th>
                  <th style="text-align: center; width: 10%;">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>  
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function () {
    let t = $('#table_mentors').DataTable({
      ajax: {
        url : "{{url('/mentor/gridview')}}",
        type : "POST",
        headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
       },
     },
     serverSide: true,
     paging: false,
     order: [[1, 'asc']],
     info: false,
     ordering:false,
     columns: [
       {target: 0, data: 'DT_RowIndex',orderable: false, searchable: false},
       {target: 1, data: 'name', className: 'center-align'},
       {target: 2, data: 'email', className: 'center-align'},
       {target: 3, data: 'mentor_photo', className: 'center-align'},
       {target: 4, data: 'mentor_action', className: 'center-align'},
       ]
   });
  });

  $('#add').on('click', function(){
    window.open(
      "{{url('/mentor/create')}}", 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('body').on('click', '#tombol_edit', function(){
    let id = $(this).attr('data-id')
    window.open(
      "{{url('/mentor/edit')}}"+"/"+id, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  function reloadDatatable() {
    $('#table_mentors').DataTable().ajax.reload();
  }

  function run_alert(icon_val, title_val) {
    if(icon_val == 'success'){
      toastr.success(title_val)
    }else if(icon_val == 'info'){
      toastr.info(title_val)
    }
  }
</script>
@endsection