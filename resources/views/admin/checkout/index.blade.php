@extends('layouts.app')

@section('title', 'Checkout List')

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
                <h5 class="card-title">Checkout List</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body bg-light">
                <div class="row">
                  <div class="col-md-12">
                    <table id="table_checkout" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th style="text-align: center;">No</th>
                          <th style="text-align: center;">Nama Customer</th>
                          <th style="text-align: center;">Nama Camp</th>
                          <th style="text-align: center;">Harga</th>
                          <th style="text-align: center;">Status</th>
                          <th style="text-align: center;">Action</th>
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
      $('#table_checkout').DataTable({
          ajax: {
            url : "{{url('/checkout/gridview')}}",
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
            {target: 1, data: 'customer_name'},
            {target: 2, data: 'camp_name'},
            {target: 3, data: 'camp_price'},
            {target: 4, data: 'is_paid'},
            {target: 5, data: 'checkout_action'}
        ]
      });
  });

  $('body').on('click', '#tombol_edit', function(){
    let id_edit = $(this).data("id")
    window.open(
      "{{url('/camp_benefits/edit')}}"+"/"+id_edit, 
      '_blank', 
      'width=800,height=500,resizable=yes,screenx=0,screeny=0'
    );
  })

</script>
@endsection