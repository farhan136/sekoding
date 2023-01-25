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
        <h5 class="card-title">Camp List</h5>

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
            <table id="table_camps" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nama</th>
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

<!-- @section('js')
<script type="text/javascript">
  $(document).ready(function () {
    let t = $('#table_camps').DataTable({
      ajax: {
        url : "{{url('/camps/gridview')}}",
        type : "POST",
        headers: {
         'X-CSRF-TOKEN': "{{csrf_token()}}",
       },
     },
     serverSide: true,
     buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
     paging: false,
     order: [[1, 'asc']],
     info: false,
     ordering:false,
     columns: [
       {target: 0, data: 'DT_RowIndex',orderable: false, searchable: false},
       {target: 1, data: 'title', className: 'center-align'},
       {target: 2, data: 'price', className: 'center-align'},
       {target: 3, data: 'camp_banner', className: 'center-align'},
       {target: 4, data: 'camp_action', className: 'center-align'},
       ]
   });

    $("#table_camps").on('draw.dt', function(){
      let n = -1;
      $(".number").each(function () {
        $(this).html(++n);
      })
    })
  });

  $('#add').on('click', function(){
    window.open(
      "{{url('/camps/create')}}", 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('body').on('click', '#tombol_edit', function(){
    let id = $(this).attr('data-id')
    window.open(
      "{{url('/camps/edit')}}"+"/"+id, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('.delete_btn').on('click', function(){
    let id = $(this).attr('data-id')
    window.open(
      "{{url('/camps/delete')}}"+"/"+id, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  function reloadDatatable() {
    $('#table_camps').DataTable().ajax.reload();
  }
</script>
@endsection -->