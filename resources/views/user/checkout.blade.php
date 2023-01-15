@extends('layouts.user1')

@section('title', 'Checkout '. $camp->title)

@section('content')
  
<!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Checkout</h2>
          <h3>Checkout <span>{{$camp->title}}</span> Camp and Start Learning</h3>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="{{Storage::url($camp->banner)}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <form action="{{url('/camps/buy/'.$camp->id)}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <div class="form-group">
                <label>Full Name</label>
                <input type="name" class="form-control" placeholder="Full Name" readonly name="name" value="{{Auth::user()->name}}" autocomplete="off">
              </div><br>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" placeholder="Email Address" readonly name="email" value="{{Auth::user()->email}}" autocomplete="off">
              </div><br>
<!--               <div class="form-group">
                <input type="email" class="form-control" placeholder="Occupation" name="ocupation" autocomplete="off">
              </div> -->
              <div class="form-group">
                <label>Card Number</label>
                <input type="number" class="form-control" placeholder="Card Number" name="card_number" autocomplete="off">
              </div><br>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

@endsection