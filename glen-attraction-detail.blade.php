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
        $name=$data->name;
        $bannerImage=asset('front/images/internal-banner.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
	<!-- start banner sec -->
  <div class="banner">
        <div class="c-hero__background">
            <img class="img-fluid" src="{{ $bannerImage }}" title="{{ $name }}" alt="{{ $name }}">    
        </div>
       
    </div>
   <div class="breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb single-breadcrumb my-2">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fa-solid fa-house mx-1"></i>Home</a>
                <a href="{{ url('/attractions') }}" rel="nofollow"><span><i class="fa-solid fa-chevron-right mx-1"></i></span> Attractions</a>
          
                <span class="mx-1"><i class="fa-solid fa-chevron-right"></i></span> {{$name}}
            </div>
        </div>
    </div>


  @php
  $list=App\Models\Attraction::where("category_id",$data->id)->orderBy("ordering","asc")->paginate(15);
  @endphp
 <section class="memory-section">
   <div class="container">
      @php $i=1; @endphp
      <div class="row">
      @foreach($list as $c)
   
         <div class="col-11">
            <div class="row rev">
               <div class="content">
                  <div class="memory-item">
                     <div class="memory-content">
                        <h2><a @if($c->type=="internal") href="{{ url('attractions/detail/'.$c->seo_url) }}"  @else href="{{ $c->seo_url }}" target="_BLANK"    @endif>{{$c->name}}</a></h2>
                     <p><i class="fa-solid fa-location-dot"></i> {{ $c->address ?? '' }}</p>
                     <p><i class="fa-solid fa-phone"></i> {{$c->mobile ?? '' }}</p>
                     </div>
                     <a @if($c->type=="internal") href="{{ url('attractions/detail/'.$c->seo_url) }}"  @else href="{{ $c->seo_url }}" target="_BLANK"    @endif class="main-btn" id="atr">View More</a>
                  </div>
                  <!--<div class="dot">-->
                  <!--   <img src="{{ asset('front') }}/images/dot-shape.png" alt="{{$c->name}}">-->
                  <!--</div>-->
               </div>
               <div class="img">
                  <div class="memory-image">
                     <a @if($c->type=="internal") href="{{ url('attractions/detail/'.$c->seo_url) }}"  @else href="{{ $c->seo_url }}" target="_BLANK"    @endif><img src="{{asset($c->image)}}" alt="{{$c->name}}" class="img-fluid"></a>
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