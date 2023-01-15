@extends('layouts.user1')

@section('title', 'Checkout '. $camp->title)

@section('content')
  
<!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Success Checkout</h2>
          <h3>You have successfully purchased <span>{{$camp->title}}</span> Camp.</h3>
        </div>

        <div class="row">
          <div class="col-lg-12" data-aos="fade-right" data-aos-delay="100">
            <img src="{{Storage::url($camp->banner)}}" class="img-fluid" alt="">
          </div>
        </div>
        <br><br><br>
        <div class="row">
          <div class="col-lg-12" data-aos="fade-right" data-aos-delay="100">
            <a href="{{url('/home')}}" class="btn btn-success btn-block">Move to Home</a>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

@endsection