<!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <h3>Our Hardworking <span>Team</span></h3>
          <p>Berisi orang-orang yang sangat berpengalaman dibidangnya</p>
        </div>

        <div class="row">
          @foreach($mentors as $mentor)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
                <img  src="{{Storage::url($mentor->photo)}}" title="{{$mentor->name}}" class="img-fluid" style="height: 200px !important; width: 350px !important; ">
              </div>
              <div class="member-info">
                <h4>{{$mentor->name}}</h4>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section><!-- End Team Section -->