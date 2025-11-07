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
$name=$data->name;
$bannerImage=asset('front/images/breadcrumb.webp');
if($data->bannerImage){
$bannerImage=asset($data->bannerImage);
}
@endphp
@include("front.layouts.banner")
<!-- Blog Section -->
<section class="blog-wrapper section-b-space py-5">
    <div class="container">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="heading fw-medium d-inline-flex align-items-center fs-2" style="text-decoration: none">
                <i class="fas fa-arrow-left me-2 fs-20"></i> <span class="fs-50"> Back to Homepage </span>
            </a>
        </div>
        
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @forelse($blogs as $b)
                @php 
                    $date=$b->publish_date; 
                    if($date){}else{$date=$b->created_at;} 
                    $category=\App\Models\Blogs\BlogCategory::where("id",$b->blog_category_id)->first(); 
                    $titleShort = \Illuminate\Support\Str::limit($b->title, 30, '...');
                @endphp
                <div class="col">
                    <article class="h-100 overflow-hidden blog-article card">
                        <div class="position-relative">
                            @if($b->featureImage)
                                <img src="{{ asset($b->featureImage) }}" alt="{{ $b->title }}" 
                                    class="card-img-top blog-img img-fluid" style="height: 400px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images.jpeg') }}" alt="{{ $b->title }}" 
                                    class="card-img-top blog-img img-fluid" style="height: 400px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="py-4 px-4 blog_theme">
                            <h6 class="blog-feat mb-3">
                                <span class="blog-date text-white"><i class="far fa-calendar-alt heading"></i>&nbsp; {{date('d-F-Y',strtotime($date))}}</span>
                                @if($category)
                                <span class="blog-date ms-3"><i class="fas fa-list heading"></i>&nbsp;
                                    <a href="{{ url('blogs/category/'.$category->seo_url) }}/" class="text-white text-decoration-none">{{$category->title}}</a>
                                </span>
                                @endif
                            </h6>
                            
                            <h2 class="card-title h4 fw-bold mb-3">
                                <a href="{{ url('blog/'.$b->seo_url) }}/" class="heading text-decoration-none hover-title" title="{{ $b->title }}">
                                    {{ $titleShort }}
                                </a>
                            </h2>
                            
                            <p class="card-text mb-4">{{ \Illuminate\Support\Str::limit($b->shortDescription, 100) }}</p>
                            
                            <a href="{{ url('blog/'.$b->seo_url) }}/" class="read-more-link d-inline-flex align-items-center text-decoration-none fw-semibold">
                                <span class="text-uppercase position-relative text-white">READ MORE</span>
                                <i class="fas fa-chevron-right ms-2 text-white transition-icon"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-danger">No any Blogs Found.</div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{$blogs->links()}}
            </div>
        </div>
    </div>
</section>
{!! $data->seo_section !!}
@stop
@section("css")
@parent
<style>
    .content-wrapper {
        display: flex;
        justify-content: center;
    }
    
    .section-b-space {
        padding: 5rem 0;
    }
    
    .text-center-flex {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
    }
    
    .blog_theme {
        background-color: var(--primary-dark);
        color: var(--primary-light);
    }
    .blog_bg {
        background-color: var(--secondary-dark);
    }
    .blog-wrapper p {
        color: var(--primary-light) !important;
    }
    
    .heading {
        color: var(--gold);
    }
    
    .margin_atr {
        margin-top: 80px;
    }
    
    @media (min-width: 992px) {
        .margin_atr {
            margin-top: 100px;
        }
    }
    
    .fs-50 {
        font-size: 30px;
        text-decoration: underline;
    }
    
    .fs-20 {
        font-size: 20px;
        text-decoration: none;
    }
    
    /* Blog styling */
    .blog-img {
        transition: transform 0.3s ease;
    }
    
    .blog-img:hover {
        transform: scale(1.05);
    }
    
    .hover-title:hover {
        color: var(--secondary-light) !important;
    }
    
    .read-more-link .text-uppercase::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: var(--secondary-light);
        transition: width 0.3s;
    }
    
    .read-more-link:hover .text-uppercase::after {
        width: 100%;
        transition: width 0.3s;
    }
    
    .transition-icon {
        transition: transform 0.3s ease;
    }
    
    .read-more-link:hover .transition-icon {
        transform: translateX(5px);
    }
    
    .blog-date {
        font-size: 0.9rem;
    }
    
    .blog-feat {
        font-weight: 500;
    }
    
    .blog-article {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .blog-article:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .pagination .page-item .page-link {
        color: var(--primary-dark);
        border-color: var(--secondary-light);
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--secondary-dark);
        border-color: var(--secondary-dark);
        color: var(--primary-light);
    }
    
    .pagination .page-link:hover {
        background-color: var(--secondary-light);
    }
</style>
@stop 
@section("js")
@parent
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script>
    // external js: masonry.pkgd.js, imagesloaded.pkgd.js
    
    // init Masonry
    var $grid = $('.grid').masonry({
    itemSelector: '.grid-item',
    percentPosition: true,
    columnWidth: '.grid-sizer'
    });
    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
    $grid.masonry();
    });  
</script>
@stop