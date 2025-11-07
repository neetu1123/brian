@php
try {
    $setting_data = \App\Models\BasicSetting::pluck('value', 'name')->toArray();
} catch (\Throwable $e) {
    $setting_data = [];
}
@endphp
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
@stop
@section("container")
  @php
  $list=App\Models\Attraction::where("category_id",$data->id)->orderBy("ordering","asc")->paginate(100);
  @endphp
  <style>
      .memory-section {
    padding: 60px 0;
    background-color: #fff;
}

.memory-item {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
    height: 100%;
}

.memory-content {
    padding: 30px;
}

.memory-content h2 {
    color: #333;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: 600;
}

.memory-content .description {
    color: #666;
    line-height: 1.8;
    font-size: 16px;
}

.memory-image {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}

.memory-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.memory-item:hover {
    transform: translateY(-5px);
}

.memory-image img:hover {
    transform: scale(1.05);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .memory-section {
        padding: 40px 0;
    }

    .memory-content {
        padding: 20px;
    }

    .memory-content h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .memory-image {
        margin-bottom: 20px;
    }

    .col-12.mb-5:last-child {
        margin-bottom: 0 !important;
    }

    /* Force image first, content second in mobile view */
    .row.align-items-center {
        flex-direction: column !important;
    }

    .img.col-md-6 {
        order: 1;
        margin-bottom: 20px;
    }

    .content.col-md-6 {
        order: 2;
    }

    /* Reset any reverse flex from desktop view */
    .flex-md-row-reverse {
        flex-direction: column !important;
    }
}

@media (max-width: 576px) {
    .memory-content {
        padding: 15px;
    }

    .memory-content h2 {
        font-size: 22px;
    }

    .memory-content .description {
        font-size: 15px;
    }
}
  </style>
 <section class="memory-section py-5">
   <div class="container">
      @php $i=1; @endphp
      <div class="row justify-content-center">
      @foreach($list as $c)
         <div class="col-12 mb-5">
            <div class="row align-items-center @if($i % 2 == 0) flex-md-row-reverse @endif">
               <div class="content col-md-6 mb-4 mb-md-0">
                  <div class="memory-item h-100 d-flex flex-column justify-content-center">
                     <div class="memory-content p-4">
                        <h2 class="mb-4">{{$c->name}}</h2>
                        <div class="description">
                           {!! $c->description !!}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="img col-md-6">
                  <div class="memory-image">
                    <img src="{{asset($c->image)}}" alt="{{$c->name}}" class="img-fluid rounded shadow">
                  </div>
               </div>
            </div>
         </div>
      @php $i++; @endphp
      @endforeach
      </div>

      <div class="row align-items-center">
         {{ $list->links()}}
      </div>
   </div>
</section>
{!! $data->seo_section !!}
@stop
@section("css")
@parent
<link rel="stylesheet" href="{{ asset('front')}}/css/attraction.css" />
<link rel="stylesheet" href="{{ asset('front')}}/css/attraction-responsive.css" />
@stop 
@section("js")
@parent
<script src="{{ asset('front')}}/js/attraction.js" ></script>
@stop