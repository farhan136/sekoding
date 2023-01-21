@extends('layouts.user1')

@section('title', 'Dashboard '. Auth::user()->name)

@section('content')
  
    <section id="dashboard" class="dashboard section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>My Dashboard</h2>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-right" data-aos-delay="100">
            <table id="table_checkoutted" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Nama</th>
                  <th style="text-align: center;">Harga</th>
                  <th style="text-align: center;">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($checkoutted as $cout)
                <tr>
                  <td style="text-align: center;">{{$loop->iteration}}</td>
                  <td style="text-align: center;">{{$cout->camps->title}}</td>
                  <td style="text-align: center;">{{$cout->camps->price}}</td>
                  <td style="text-align: center;">
                    @if($cout->is_paid == 1)
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_tutorial">Paid</button>
                    @else
                      <button class="btn btn-danger btn-sm">Not Paid</button>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br><br><br>
        <div class="row">
          <div class="col-lg-12" data-aos="fade-right" data-aos-delay="100">
            <a href="{{url('/')}}" class="btn btn-success btn-block">Move to Home</a>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal_tutorial" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="header_modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
