@extends('layouts.user1')

@section('title', 'SEKODING')

@section('mainbanner')
  @include('components.userhero')
@endsection

@section('content')
  
      <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">
        <h3 style="text-align:center; margin-bottom:30px;">Our <span style="color:#106EEA; font-weight: bold;">Camp</span> List</h3>
        <div class="row">
          @foreach($camps as $camp  )
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <img src="{{Storage::url($camp->banner)}}" width="200" height="170" class="mb-5 ml-2 mr-2">
              
              <h4 class="title"><a href="">{{$camp->title}}</a></h4>

              <ul>
                @foreach($camp->benefit as $benefit)
                  <li class="title" style="font-size: 14px;">{{$benefit->name}}</li>
                  <hr>
                @endforeach
              </ul>
              @isset($checkoutted)
                @foreach($checkoutted as $co)
                  @if($co->camp_id == $camp->id)
                    <button class="btn btn-secondary btn-sm" style="width: 100%;">See This Camp</button>
                  @else
                    <!-- <a class="btn btn-success btn-sm" href="{{url('/camps/checkout/'.$camp->slug)}}" style="width: 100%;">Join Us</a> -->
                  @endif
                @endforeach
              @else
                <a class="btn btn-success btn-sm" href="{{url('/camps/checkout/'.$camp->slug)}}" style="width: 100%;">Join Us</a>
              @endisset
              
              
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section>

    @include('components.useraboutus')

    @include('components.usercounts')

    @include('components.userteam')
    
    @include('components.usercontact')

@endsection