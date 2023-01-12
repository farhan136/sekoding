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
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body bg-light">
                <div class="row">
                  <div class="col-md-12">
                    <table id="table_camps" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th style="text-align: center;">Nama</th>
                          <th style="text-align: center;">Judul</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>  
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function () {
      $('#table_camps').DataTable({
          ajax: {
            url : "{{url('/gridview')}}",
            type : "POST",
            headers: {
               'X-CSRF-TOKEN': "{{csrf_token()}}",
            },
          },
          serverSide: true,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          // paging: false,
          info: false,
          order:false,
          columns: [
              {target: 0, data: 'title', className: 'center-align'},
              {target: 1, data: 'slug', className: 'center-align'},
          ]
      });
  });
</script>
@endsection