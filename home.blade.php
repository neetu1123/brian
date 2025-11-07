@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@php $payment_currency=ModelHelper::getDataFromSetting('payment_currency');@endphp
@stop
@section("container")
<!-- colors.css -->
<link rel="stylesheet" href="/public/uinew/css/colors.css">
<link rel="stylesheet" href="/public/uinew/style.css">
<link rel="stylesheet" href="/public/uinew/css/enhanced-style.css">
 <script>
      // Load header and footer
      document.addEventListener("DOMContentLoaded", function () {
        fetch("header.html")
          .then((response) => response.text())
          .then((data) => {
            document.getElementById("header-placeholder").innerHTML = data;
          });

        fetch("footer.html")
          .then((response) => response.text())
          .then((data) => {
            document.getElementById("footer-placeholder").innerHTML = data;
          });
      });
    </script>
    <style>
    /* hero */
	.hero-section {
		background: url('{{ asset('front/images/homebrian.jpeg') }}') no-repeat center center;
		 /*background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.5)), url('e639fda3ec544dd5a3c8c198152a35b3-Medium.jpeg');*/
    background-size: cover;
    background-position: center;
    /* background-attachment: fixed; */
    height: 90vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    color: #fff;
    z-index: 1;
    padding: 60px 0 80px;
    /*overflow: hidden;*/
    min-height: 70%;

	}
  @media (max-width: 767px) {
      	.hero-section {
      	    background: url('{{ asset('front/images/homebrian.jpeg') }}') no-repeat center center;
      	    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 50vh !important;
    min-height: 50%;
      	}
  }
          .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
        }
            .banner-content {
            position: relative;
            text-align: center;
            width: 100%;
            color: white;
            z-index: 1;
        }

      .property-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
      }

      .property-card:hover {
        transform: translateY(10px);
        /* box-shadow: 0 8px 30px rgba(0,0,0,0.12); */
      }

      .property-image {
        position: relative;
        height: 280px;
        overflow: hidden;
      }

      .property-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
      }

      /* Fixed empty ruleset */
      .property-card:hover .property-image img {
        /* transform: scale(1.05); */
      }

      .heart-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        background: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      }

      .heart-icon i {
        color: #ccc;
        font-size: 18px;
      }

      .amenities {
        background: rgba(255, 255, 255, 0.95);
        position: absolute;
        bottom: -20px;
        left: 12px;
        right: 12px;
        padding: 15px;
        border-radius: 8px;
        /* display: flex; */
        /* justify-content: space-around; */
        /* backdrop-filter: blur(10px); */
      }

      .amenity {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #666;
        font-weight: 500;
      }

      .amenity i {
        color: #3498db;
        font-size: 14px;
      }

      .property-details {
        padding: 20px;
      }

      .property-titles {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 10px;
      }

      .property-name {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
      }

      .rating-badge {
        background: #3498db;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
      }

      .rating-badge.rating-35 {
        background: #e67e22;
      }

      .stars {
        display: flex;
        gap: 2px;
        margin-left: 5px;
      }

      .star {
        color: #ffc107;
        font-size: 14px;
      }

      .star.empty {
        color: #dee2e6;
      }

      .location {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #666;
        font-size: 14px;
        margin-bottom: 20px;
      }

      .location i {
        color: #3498db;
      }

      .pricing-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #eee;
      }

      .price-info {
        display: flex;
        flex-direction: column;
      }

      .from-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 2px;
      }

      .price {
        font-size: 20px;
        font-weight: 700;
        color: #3498db;
      }

      .per-night {
        font-size: 14px;
        color: #666;
        font-weight: normal;
      }

      .view-details {
        background: transparent;
        border: none;
        color: #666;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: color 0.3s ease;
        text-decoration: none;
      }

      .view-details:hover {
        color: #3498db;
      }

      .view-details i {
        font-size: 16px;
      }

      .highlighted-card {
        /* border: 3px solid #e74c3c; */
        position: relative;
      }

      .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
      }

      @media (max-width: 768px) {
        .amenities {
          flex-wrap: wrap;
          gap: 6px;
          padding: 10x;
          bottom: -5px;
        }

        .amenity {
          font-size: 11px;
        }

        .property-name {
          font-size: 16px;
        }

        .price {
          font-size: 18px;
        }
      }

      .star-location {
        display: flex;
        justify-content: space-between;
        gap: 5px;
        font-size: 14px;
        /* margin-bottom: 10px; */
      }

      .property-amenities-list-wrap {
        display: flex;
        gap: 25px;
        margin: 0;
        font-size: 14px;
        justify-content: center;
        list-style: none;
      }

      .property-amenities-list {
        display: flex;
        align-items: center;
      }

      .property-amenities-list-wrapper {
        display: flex;
        justify-content: center;
      }

      .property-amenities-name span {
        margin-left: 4px;
        font-weight: 500;
      }
      .property-amenities-name span i {
        margin-right: 5px;
        /* font-weight: 500; */
      }
      .separator {
        color: #aaa;
        font-size: 16px;
      }

      /* Enhanced Banner Styles */
      .video-cont {
        text-align: center;
        width: 100%;
      }

      .text-secondary-light {
        color: var(--secondary-light, #EFAD29);
        font-weight: bold;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      .text-primary-light {
        color: white;
        font-weight: 800;
        font-size: 2.5rem;
        line-height: 1.2;
        margin-bottom: 1.5rem;
      }

      .text-accent {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        line-height: 1.6;
        font-weight: 400;
      }

      .banner-content-wrap {
        text-align: center;
        max-width: 1200px;
        margin: 0 auto 2rem;
        padding-top: 4rem;
      }

      @media (max-width: 992px) {
        .text-primary-light {
          font-size: 2rem;
        }
      }

      @media (max-width: 768px) {
        .text-primary-light {
          font-size: 1.8rem;
        }

        .text-accent {
          font-size: 1rem;
        }
              .first-about {
                margin-top: 20rem;
           
      }
          .attraction-img {
         min-height: 350px; 
    }

      }
      
      
      @media (max-width: 991px) {
        div#guestsss {
         width: 90%
        }
    .testimonial-content {
        height: auto !important;
        min-height: auto !important;
    }
    
    .testimonial-text {
        font-size: 16px;
        line-height: 1.5;
    }
    
    .testimonial-author {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .carousel-inner {
        height: auto;
    }
    
    .testimonial-quote {
        font-size: 2rem !important;
    }
}

    .carousel-inner {
        height: auto;
    }
    
    .testimonial-content blockquote {
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
    }
@media (minx-width: 991px) {
    .testimonial-section {
            height: 700px;
    }
}

    /* Testimonial section height fixes */
    @media (max-width: 991px) {
        .testimonial-content {
            height: 470px !important;
            min-height: 470px !important;
        }
        
        .carousel-inner {
            height: 470px !important;
        }
    }
    </style>
@php
try {
    $setting_data = \App\Models\BasicSetting::pluck('value', 'name')->toArray();
} catch (\Throwable $e) {
    $setting_data = [];
}
@endphp
<!-- Video section start -->
<section class="hero-section">
    <div class="banner-overlay"></div>
	<div class="container">
		<div class="banner-content">
 <h5 class="text-secondary-light mb-3">VA MOUNTAIN CABINS</h5>
			<h1 class="lead mx-auto display-3 fw-bold text-white" style="max-width: 1200px">WE CAN'T WAIT TO WELCOME YOU TO THE MOUNTAINS</h1>
			<p class="lead mx-auto text-white pb-3" style="max-width: 600px">

Discover a unique selection of beautiful vacation rentals in the scenic Virginia Mountains.
			</p>

   	<div class="search-bar">
					<form method="get" action="{{ url('properties') }}">
						<div class="row">
							<div class="col-4 md-12 sm-12 select">
								{!! Form::select("location_id",ModelHelper::getLocationSelectList(),null,["class"=>"","placeholder"=>"Location","title"=>"Location","id"=>"loc"]) !!}
							</div>
							<div class="col-4 col-lg md-8 icns mb-lg-0 position-relative  datepicker-section datepicker-common-2 main-check">
								<div class="row">
									<div class="check left icns mb-lg-0 position-relative datepicker-common-2">
										{!! Form::text("start_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date","placeholder"=>"Arrive","class"=>"form-control"]) !!}
										<i class="fa-regular fa-calendar"></i>
									</div>
									<div class="check right icns mb-lg-0 position-relative datepicker-common-2 check-out">
										{!! Form::text("end_date",null,["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date","placeholder"=>"Depart","class"=>"form-control lst" ]) !!}
										<i class="fa-regular fa-calendar"></i>
									</div>
									<div class="col-12 md-12 sm-12 datepicker-common-2 datepicker-main">
										<input type="text" id="demo17" value="" aria-label="Check-in and check-out dates" aria-describedby="demo17-input-description" readonly />
									</div>
								</div>
							</div>
							<div class="col-2 md-12 sm-12 guest">
								<input type="text" name="Guests" readonly="" class="form-control gst" id="show-target-data" placeholder="Guests" title="Select Guests">
								<i class="fa-regular fa-user"></i>
								<input type="hidden" value="0" name="adults" id="adults-data" />
								<input type="hidden" value="0" name="child" id="child-data" />
								<div class="adult-popup" id="guestsss">
									<i class="fa fa-times close1"></i>
									<div class="adult-box">
										<div class="adult-value">
											<p id="adults-data-show">0 Adult</p>
										</div>

										<div class="adult-btn">
											<button class="button1"  type="button" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</button>
										</div>
									</div>
									<div class="adult-box">
										<div class="adult-value">
											<p id="child-data-show">0 Children</p>
										</div>
										<div class="adult-btn">
											<button class="button1" type="button"  onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Decrement Value">-</button>
											<button class="button11 button1" type="button"  onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</button>
										</div>
									</div>
									<div class="pets-box d-none">
										<p class="pets-label">Pets</p>
										<div class="pets-calculator">
											<div class="pets-value">
												<label for="pets-yes">Yes</label>
												<input type="radio" id="pets-yes" name="pets" value="Yes">
											</div>
											<div class="pets-value">
												<label for="pets-no">No</label>
												<input type="radio" id="pets-no" name="pets" value="No">
											</div>
										</div>
									</div>
									<button class="main-btn close111" type="button">Apply</button>
								</div>
							</div>
							<div class="col-2 md-12 sm-12 srch-btn">
								<button type="submit" class="main-btn">Search</button>
							</div>
						</div>
					</form>
				</div>
		</div>
	</div>
</section>
<!--<section class="video-banner">-->
<!--	@if($setting_data['home_video'])-->
<!--	<div class="video-sec">-->
<!--		{{-- Video ke jagah ab image --}}-->
<!--		<img src="{{ asset('front/images/homebrian.jpeg') }}" alt="Banner Image" class="img-fluid">-->

<!--		<div class="video-cont">-->
<!--			<div class="container">-->
				<!--{!! $setting_data['home-video-text'] !!}-->
<!--				<div class="banner-content-wrap">-->

<!--          <h1 class="text-primary-light mx-auto mb-4" >-->
<!--            WE CAN'T WAIT TO WELCOME YOU TO THE MOUNTAINS-->
<!--          </h1>-->
<!--          <p class="text-accent mx-auto mb-5" >-->
<!--            Discover a unique selection of beautiful vacation rentals in the-->
<!--            scenic Virginia Mountains.-->
<!--          </p>-->
<!--        </div>-->

<!--			</div>-->
<!--			<div class="scroll">-->
<!--				<a href="#">-->
<!--					<div class="chevron"></div>-->
<!--					<div class="chevron"></div>-->
<!--					<div class="chevron"></div>-->
<!--					<span class="text">Scroll down</span>-->
<!--				</a>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--	@endif  -->
<!--</section>-->

<!-- about section -->
    <!-- About Host Section -->
    <section class="about-host-section  first-about py-5 bg-accent">
      <div class="container">
        <div class="row align-items-center justify-content-between g-5">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <span class="about-host-subtitle text-secondary-dark"
              > {!! $data->about_heading !!}</span
            >
            <h2 class="about-host-title mb-4 text-primary-dark">
              {!! $data->about_sub_heading1 !!}
            </h2>
            <p class="about-host-desc mb-4 text-secondary-dark">
              {!! $data->longDescription !!}
            </p>
            <a
              href="{{ url('about-us') }}"
              class="btn btn-secondary-dark d-inline-flex align-items-center gap-2"
            >
              <span class="iconify" data-icon="mdi:email-outline"></span> READ
              MORE
            </a>
          </div>
          <div
            class="col-lg-6 position-relative d-flex justify-content-center align-items-center"
          >
            <div class="position-relative">
              <div>
                <img src="{{ asset($data->about_image1)}}" class="img-fluid rounded-4" alt="about">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @php
        $list = App\Models\Lodgify\LodgifyProperty::where(["is_home"=>"true","status"=>"true", "is_active"=>"1"])->orderBy("id","asc")->take(3)->get();
    @endphp
@if(count($list)>0)
    <!-- Property Section -->
<section class="property-section py-5 bg-primary-light">
  <div class="container-md">
    <div class="text-center my-4 mt-md-5">
      <span class="property-subtitle text-secondary-dark">
        {!! $data->property_sub_heading !!}
      </span>
      <h2 class="property-title mb-5 text-primary-dark">
        {!! $data->property_heading !!}
      </h2>
    </div>

    <div class="container-md">
      <div class="row g-4">
        @foreach($list as $c)
           @php $room = App\Models\Lodgify\LodgifyRoom::where(["lodgify_property_id"=>$c->lodgify_property_id])->first(); @endphp
           @if(isset($room))
          <div class="col-lg-4 col-md-6">
            <div class="property-card highlighted-card">
              <div class="property-image">
                <a href="{{ url($c->seo_url) }}">
                  <img src="{{ $c->image_url }}" alt="">
                </a>

                <div >
                  <ul class="property-amenities-list-wrap">
                    @if(($room->max_people))
                      <li class="property-amenities-list guests-amenitie amenity" title="Guests">
                        <div class="property-amenities-name">
                          <span><i class="fas fa-users"></i></span>
                          {{ $room->max_people }} <span>Guests</span>
                        </div>
                      </li>
                      <li class="separator">|</li>
                    @endif

                    @if(($room->bedrooms))
                      <li class="property-amenities-list bedrooms-amenitie amenity" title="Bedrooms">
                        <div class="property-amenities-name">
                          <span><i class="fas fa-bed"></i></span>
                          {{ $room->bedrooms }} <span>Bdrm</span>
                        </div>
                      </li>
                      <li class="separator">|</li>
                    @endif

                    @if(($room->bathrooms))
                      <li class="property-amenities-list bathrooms-amenitie amenity" title="Bathrooms">
                        <div class="property-amenities-name">
                          <span><i class="fas fa-bath"></i></span>
                          {{ $room->bathrooms }} <span>Baths</span>
                        </div>
                      </li>
                    @endif
                  </ul>
                </div>
              </div>

              <div class="property-details">
                <div class="property-titles">
                  <h3 class="property-name">
                    <a href="{{ url($c->seo_url) }}">{{ $c->name }}</a>
                  </h3>
                </div>

                <div class="star-location">
                  <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    @if($c->address)
                    <!--<span>{{ $c->address }}, {{ $c->city }}, {{ $c->country }}</span>-->
                      <span>{{ $c->city }}, {{ $c->country }}</span>
                    @endif
                  </div>
                  <div class="stars">
                    <i class="fas fa-star star"></i>
                    <i class="fas fa-star star"></i>
                    <i class="fas fa-star star"></i>
                    <i class="fas fa-star star"></i>
                    <i class="fas fa-star star"></i>
                  </div>
                </div>

                <div class="pricing-section">
                  <div class="price-info">
                    <div class="from-text">From</div>
                    @if($c->original_min_price)
                      <div class="price">
                        {{ $payment_currency ?? 'USD' }}
                        {{ $c->original_min_price }}
                        <span class="per-night">/night</span>
                      </div>
                    @endif
                  </div>
                  <a href="{{ url($c->seo_url) }}" class="view-details">
                    VIEW DETAILS <i class="fas fa-arrow-right"></i>
                </a>

                </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>

      <!-- View More button OUTSIDE foreach -->
      <div class="text-center mt-5">
        <a href="{{ url('properties') }}" class="btn px-4 py-3"
           style="background-color: var(--secondary-dark); color: white; border-radius: 50px; font-weight: 700;">
          <span class="iconify me-2" data-icon="mdi:view-grid-plus"></span>
          VIEW MORE PROPERTIES
        </a>
      </div>
    </div>
  </div>
</section>
@endif

   <!-- Testimonial Section -->
@if(App\Models\Testimonial::where("status","true")->count()>0)
<section class="testimonial-section py-5 bg-secondary-light">
  <div class="container py-4">
    <div class="text-center mb-5">
      <span class="text-secondary-dark fw-bold text-uppercase letter-spacing-2">
        {!! $data->testimonial_heading !!}
      </span>
      <h2 class="text-primary-dark mt-2 mb-0 fw-bold">
        {!! $data->testimonial_sub_heading !!}
      </h2>
    </div>

    <div class="row g-5 align-items-center">
      <!-- Fixed Left Image -->
      <div class="col-lg-5">
        <div class="testimonial-img-wrap position-relative">
       @if($data->review_image)   <img src="{{ asset($data->review_image) }}" class="img-fluid rounded-4 shadow testimonial-img" alt="User">@endif
          <div class="bg-white shadow p-3 rounded-3 position-absolute bottom-0 end-0 translate-middle-y">
            <div class="d-flex align-items-center gap-2">
              <div class="property-rating text-warning">
                <span class="iconify" data-icon="mdi:star"></span>
                <span class="iconify" data-icon="mdi:star"></span>
                <span class="iconify" data-icon="mdi:star"></span>
                <span class="iconify" data-icon="mdi:star"></span>
                <span class="iconify" data-icon="mdi:star"></span>
              </div>
              <span class="fw-bold text-primary-dark">5.0</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Side Carousel -->
      <div class="col-lg-7">
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="false">
          <div class="carousel-inner">
            @foreach(App\Models\Testimonial::where("status","true")->orderBy("stay_date","desc")->take(6)->get() as $c)
            <div class="carousel-item @if($loop->first) active @endif">
              <div class="testimonial-content position-relative ps-lg-4">
                <span class="iconify testimonial-quote"
                      data-icon="mdi:format-quote-open"
                      style="font-size: 3rem; color: #0a3d65"></span>
                <blockquote class="testimonial-text fw-bold mb-4 text-primary-dark">
                  "{{$c->message}}!"
                </blockquote>
                <div class="testimonial-author d-flex align-items-center mb-4">
                  <div class="bg-primary-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px">
                    @if($c->image)
                    <span class="text-white fw-bold">
                        <img src="{{asset($c->image)}}" style="width:50px;height:50px;border-radius:50%;">
                    </span>
                    @endif
                  </div>
                  <div>
                    <div class="fw-bold text-primary-dark">{{$c->name}}</div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <!-- Carousel Nav -->
          <div class="testimonial-nav d-flex gap-3 justify-content-center mt-4">
            <button class="btn testimonial_index-btn shadow-sm" type="button"
                    data-bs-target="#testimonialCarousel" data-bs-slide="prev"
                    aria-label="Previous testimonial">
              <span class="iconify" data-icon="mdi:arrow-left"></span>
            </button>
            <button class="btn testimonial_index-btn shadow-sm" type="button"
                    data-bs-target="#testimonialCarousel" data-bs-slide="next"
                    aria-label="Next testimonial">
              <span class="iconify" data-icon="mdi:arrow-right"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

    <!-- Attraction Section -->
    <section class="attraction-section py-5 bg-primary-light">
      <div class="container">
        <div class="text-center mb-4">
          <span class="attraction-subtitle text-secondary-dark"></span>
            {!! $data->attraction_sub_heading !!}
          </span>
          <h2 class="attraction-title mb-4 text-primary-dark">
            {!! $data->attraction_heading !!}
          </h2>
        </div>
        <div class="position-relative mobile-slider-container">
          <button
            class="btn icon_btn nav-btn prev-btn d-md-none"
            id="attraction-prev"
            aria-label="Previous attraction"
          >
            <span class="iconify" data-icon="mdi:chevron-left"></span>
          </button>
          
          <div class="attraction-slider">
            <div class="attraction-cards-container" id="attraction-cards-container">
              @foreach(App\Models\AttractionCategory::orderBy("ordering","desc")->take(4)->get() as $c)
              <div class="attraction-card-col">
                <a href="{{url('attractions/category/'.$c->seo_url)}}">
                  <div class="attraction-card card h-100 border-0">
                    @if($c->image)
                    <img src="{{ asset($c->image)}}" class="card-img-top attraction-img" alt="{{$c->name}}">
                    @endif
                    <div class="card-img-overlay d-flex align-items-end justify-content-center p-0">
                      <div class="attraction-caption w-100 text-center">
                        {{$c->name}}
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
          </div>

          <button
            class="btn icon_btn nav-btn next-btn d-md-none"
            id="attraction-next"
            aria-label="Next attraction"
          >
            <span class="iconify" data-icon="mdi:chevron-right"></span>
          </button>
        </div>

        <div class="text-center mt-4">
          <a href="{{url('attractions')}}"
             class="btn btn-secondary-dark px-4 py-3 shadow-sm rounded-pill d-inline-flex align-items-center">
            <span class="iconify me-2" data-icon="mdi:map-marker"></span>
            VIEW ALL ATTRACTIONS
          </a>
        </div>
      </div>
    </section>

    <style>
    .mobile-slider-container {
      position: relative;
      overflow: hidden;
      padding: 0 15px;
    }

    .attraction-slider {
      overflow: hidden;
      width: 100%;
    }

    .attraction-cards-container {
      display: flex;
      transition: transform 0.3s ease;
      gap: 20px;
    }

    @media (min-width: 768px) {
      .attraction-card-col {
        flex: 0 0 calc(25% - 15px);
        max-width: calc(25% - 15px);
      }
    }

    @media (max-width: 767px) {
      .attraction-card-col {
        flex: 0 0 100%;
        max-width: 100%;
      }

      .mobile-slider-container {
        display: flex;
        align-items: center;
      }

      .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
      }

      .nav-btn:hover {
        background: white;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }

      .nav-btn.prev-btn {
        left: 0;
      }

      .nav-btn.next-btn {
        right: 0;
      }

      .nav-btn .iconify {
        font-size: 24px;
        color: #333;
      }

      .attraction-img {
        height: 300px;
        object-fit: cover;
      }

      .attraction-caption {
        background: rgba(0,0,0,0.7);
        padding: 15px;
        font-size: 18px;
        font-weight: 600;
        color: white;
      }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const container = document.getElementById('attraction-cards-container');
      const prevBtn = document.getElementById('attraction-prev');
      const nextBtn = document.getElementById('attraction-next');
      let currentSlide = 0;
      let startX;
      let isSwiping = false;

      function updateSlidePosition() {
        const slideWidth = container.querySelector('.attraction-card-col').offsetWidth;
        const translateX = -currentSlide * (slideWidth + 20); // 20px is the gap
        container.style.transform = `translateX(${translateX}px)`;
        updateButtons();
      }

      function updateButtons() {
        const slides = container.querySelectorAll('.attraction-card-col');
        prevBtn.style.opacity = currentSlide === 0 ? '0.5' : '1';
        nextBtn.style.opacity = currentSlide === slides.length - 1 ? '0.5' : '1';
        prevBtn.disabled = currentSlide === 0;
        nextBtn.disabled = currentSlide === slides.length - 1;
      }

      // Touch events for swipe
      container.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        isSwiping = true;
      }, { passive: true });

      container.addEventListener('touchmove', (e) => {
        if (!isSwiping) return;
        const currentX = e.touches[0].clientX;
        const diff = startX - currentX;
        if (Math.abs(diff) > 50) {
          if (diff > 0 && currentSlide < container.children.length - 1) {
            currentSlide++;
          } else if (diff < 0 && currentSlide > 0) {
            currentSlide--;
          }
          isSwiping = false;
          updateSlidePosition();
        }
      }, { passive: true });

      container.addEventListener('touchend', () => {
        isSwiping = false;
      });

      // Button click events
      prevBtn.addEventListener('click', () => {
        if (currentSlide > 0) {
          currentSlide--;
          updateSlidePosition();
        }
      });

      nextBtn.addEventListener('click', () => {
        if (currentSlide < container.children.length - 1) {
          currentSlide++;
          updateSlidePosition();
        }
      });

      // Handle window resize
      let resizeTimer;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          currentSlide = 0;
          updateSlidePosition();
        }, 250);
      });

      // Initialize
      updateSlidePosition();
    });
    </script>

    <!-- About Host Section -->
    <section class="about-host-section py-5 bg-accent">
      <div class="container">
        <div class="row align-items-center justify-content-between g-5">
          <div class="col-lg-6 mb-4 mb-lg-0">

            <h2 class="about-host-title mb-4 text-primary-dark">
              {!! $data->strip_title !!}
            </h2>
            <p class="about-host-desc mb-4 text-secondary-dark">
              {!! $data->strip_desction !!}
            </p>
            <a
              href="contact.html"
              class="btn btn-secondary-dark d-inline-flex align-items-center gap-2"
            >
              <span class="iconify" data-icon="mdi:email-outline"></span> READ
              MORE
            </a>
          </div>
          <div
            class="col-lg-6 position-relative d-flex justify-content-center align-items-center"
          >
            <div class="position-relative">
              <div>
               <img src="{{ asset($data->strip_image) }}" class="img-fluid rounded-4" alt="">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



@stop
@section("css")
@parent
<link rel="stylesheet" href="{{ asset('front')}}/assets/owl/owl.carousel.min.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/home.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/home-responsive.css" />
@section("css")
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('datepicker') }}/dist/css/hotel-datepicker.css"/>
<link rel="stylesheet" href="{{ asset('front')}}/css/datepicker.css" />
@stop
@stop
@section("js")
@parent
<script src="{{ asset('front')}}/assets/owl/owl.carousel.min.js" ></script>
<script src="{{ asset('front')}}/js/home.js" ></script>
<script>
	var val=0;
	function functiondec($getter_setter,$show,$cal){
	val=parseInt($($getter_setter).val());
	if(val>0){
	    val=val-1;
	}
	$($getter_setter).val(val);
	//console.log(val);
	person1=val;
	person2=parseInt($($cal).val());
	$show_data=person1+person2;
	$show_actual_data=$show_data+" Guests";
	if($getter_setter=="#adults-data"){
	    $($getter_setter+'-show').html(val +" Adults");
	    if(val<=1){
	       $($getter_setter+'-show').html(val +" Adult");
	    }
	}else{
	     $($getter_setter+'-show').html(val +" Children");
	    if(val<=1){
	       $($getter_setter+'-show').html(val +" Child");
	    }
	}
	$($show).val($show_actual_data);
	}
	function functioninc($getter_setter,$show,$cal){
	val=parseInt($($getter_setter).val());
	//  console.log(val)
	    val=(val*1)+1;
	//  console.log(val)
	$($getter_setter).val(val);
	person1=val;
	person2=parseInt($($cal).val());
	$show_data=person1+person2;
	$show_actual_data=$show_data+" Guests";
	$($show).val($show_actual_data);
	if($getter_setter=="#adults-data"){
	    $($getter_setter+'-show').html(val +" Adults");
	    if(val<=1){
	       $($getter_setter+'-show').html(val +" Adult");
	    }
	}else{
	     $($getter_setter+'-show').html(val +" Children");
	    if(val<=1){
	       $($getter_setter+'-show').html(val +" Child");
	    }
	}
	}
</script>
<script src="{{ asset('datepicker') }}/node_modules/fecha/dist/fecha.min.js"></script>
<script src="{{ asset('datepicker') }}/dist/js/hotel-datepicker.js"></script>
<script>
	@php
	    $new_data_blocked=LiveCart::iCalDataCheckInCheckOutCheckinCheckout(0000);
	    $checkin=json_encode($new_data_blocked['checkin']);
	    $checkout=json_encode($new_data_blocked['checkout']);
	    $blocked=json_encode($new_data_blocked['blocked']);

	@endphp

	      var checkin = <?php echo $checkin;  ?>;
	    var checkout = <?php echo ($checkout);  ?>;
	    var blocked= <?php echo ($blocked);  ?>;



	    function clearDataForm(){
	        $("#start_date").val('');
	        $("#end_date").val('');

	    }
	            (function () {
	                @if(Request::get("start_date"))
	                    @if(Request::get("end_date"))
	                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}");
	                    @endif
	                @endif
	                abc=document.getElementById("demo17");
	                var demo17 = new HotelDatepicker(
	                    abc,
	                    {
	                        @if($checkin)
	                        noCheckInDates: checkin,
	                        @endif
	                        @if($checkout)
	                        noCheckOutDates: checkout,
	                        @endif
	                        @if($blocked)
	                         disabledDates: blocked,
	                        @endif
	                        onDayClick: function() {
	                             d = new Date();
	                                d.setTime(demo17.start);
	                                document.getElementById("start_date").value = getDateData(d);
	                                d = new Date();
	                                console.log(demo17.end)
	                                if(Number.isNaN(demo17.end)){
	                                    document.getElementById("end_date").value = '';
	                                }else{
	                                     d.setTime(demo17.end);
	                                    document.getElementById("end_date").value = getDateData(d);
	                                   // ajaxCallingData();
	                                }
	                        },
	                        clearButton:function(){
	                            return true;
	                        }
	                    }
	                );

	                        @if(Request::get("start_date"))
	                            @if(Request::get("end_date"))
	                                setTimeout(function(){
	                                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}")
	                                        document.getElementById("start_date").value ="{{ request()->start_date }}";
	                                        document.getElementById("end_date").value ="{{ request()->end_date }}";

	                                    },1000);

	                            @endif
	                        @endif

	            })();

	            $(document).on("click","#clear",function(){
	                $("#clear-demo17").click();
	            })
	            x=document.getElementById("month-2-demo17");
	            x.querySelector(".datepicker__month-button--next").addEventListener("click", function(){
	                y=document.getElementById("month-1-demo17");
	                y.querySelector(".datepicker__month-button--next").click();
	            })  ;


	            x=document.getElementById("month-1-demo17");
	            x.querySelector(".datepicker__month-button--prev").addEventListener("click", function(){
	                y=document.getElementById("month-2-demo17");
	                y.querySelector(".datepicker__month-button--prev").click();
	            })  ;



	          function getDateData(objectDate){

	            let day = objectDate.getDate();
	            //console.log(day); // 23

	            let month = objectDate.getMonth()+1;
	            //console.log(month + 1); // 8

	            let year = objectDate.getFullYear();
	           // console.log(year); // 2022


	            if (day < 10) {
	                day = '0' + day;
	            }

	            if (month < 10) {
	                month = `0${month}`;
	            }
	            format1 = `${year}-${month}-${day}`;
	            return  format1 ;
	            console.log(format1); // 07/23/2022
	          }
</script>
  <script>
    // Add interactive functionality
    document.addEventListener("DOMContentLoaded", function () {
      // Heart icon toggle
      const heartIcons = document.querySelectorAll(".heart-icon");
      heartIcons.forEach((heart) => {
        heart.addEventListener("click", function (e) {
          e.preventDefault();
          const icon = this.querySelector("i");
          if (icon.classList.contains("far")) {
            icon.classList.remove("far");
            icon.classList.add("fas");
            icon.style.color = "#e74c3c";
          } else {
            icon.classList.remove("fas");
            icon.classList.add("far");
            icon.style.color = "#ccc";
          }
        });
      });

      // View details button hover effect
      const viewDetailsButtons = document.querySelectorAll(".view-details");
      viewDetailsButtons.forEach((button) => {
        button.addEventListener("click", function () {
          console.log(
            "View details clicked for:",
            this.closest(".property-card").querySelector(".property-name")
              .textContent
          );
        });
      });

      // Card hover animations
      const propertyCards = document.querySelectorAll(".property-card");
      propertyCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-8px)";
        });

        card.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0)";
        });
      });
    });
  </script>
@stop
