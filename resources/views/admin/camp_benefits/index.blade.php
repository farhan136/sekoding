@extends('layouts.app')

@section('title', 'SEKODING')

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
                <h5 class="card-title">Camp Benefit List</h5>

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
                          <th></th>
                          <th style="text-align: center;">Konten</th>
                          <th style="text-align: center;">Camp</th>
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
      $('#table_camps').DataTable({
          ajax: {
            url : "{{url('/camp_benefits/gridview')}}",
            type : "POST",
            headers: {
               'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
          },
          serverSide: true,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          paging: false,
          order: [[0, 'asc']],
          info: false,
          ordering:false,
          columns: [
            {target: 0, data: 'DT_RowIndex',orderable: false, searchable: false},
            {target: 1, data: 'name'},
            {target: 2, data: 'camp_name'},
            {target: 3, data: 'benefit_action'}
        ]
      });
  });

  $('#add').on('click', function(){
    window.open(
        "{{url('/camp_benefits/create')}}", 
        '_blank', 
        'width=800,height=500,resizable=yes,screenx=0,screeny=0'
      );
  });

  $('body').on('click', '#tombol_edit', function(){
    let id_edit = $(this).data("id")
    window.open(
      "{{url('/camp_benefits/edit')}}"+"/"+id_edit, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

  function reloadDatatable() {
    $('#table_camps').DataTable().ajax.reload();
  }
</script>
@endsection