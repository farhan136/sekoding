@extends('layouts.user1')

@section('title', 'Checkout '. $checkout->camps->title)

@section('content')
  
<!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Success Checkout</h2>
          <h3>You have successfully purchased <span>{{$checkout->camps->title}}</span> Camp.</h3>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-right" data-aos-delay="100">
            <img src="{{Storage::url($checkout->camps->banner)}}" class="img-fluid" alt="">
          </div>
        </div>
        <br><br><br>
        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <a href="{{url('/home')}}" class="btn btn-primary btn-block">Move to Home</a>
          </div>
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <a href="{{$checkout->midtrans_url}}" target="_blank" class="btn btn-success btn-block">Selesaikan Pembayaran</a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

@endsection