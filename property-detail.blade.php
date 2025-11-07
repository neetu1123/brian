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
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop

@section("container")
@php
   $currency=$setting_data['payment_currency'];
   $name=$data->name;
   $bannerImage=asset('front/images/internal-banner.webp');;
   if($data->banner_image){
      $bannerImage=asset($data->banner_image);
   }
   $room=App\Models\Lodgify\LodgifyRoom::where(["lodgify_property_id"=>$data->lodgify_property_id])->first();
   $room_id = '';
   if (isset($room)) {
    $room_id = $room->id;
   }
@endphp
<style>
/* Custom gallery styles */
.tab-active {
    border-bottom: 3px solid #14b8a6;
    color: #14b8a6;
}

.calendar-date {
    transition: all 0.2s ease;
}

.calendar-date:hover {
    transform: scale(1.05);
}

.review-card {
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.review-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.slideshow-active {
    animation: fadeInOut 0.5s ease-in-out;
}

@keyframes fadeInOut {
    0% {
        opacity: 0.7;
    }

    100% {
        opacity: 1;
    }
}

.thumbnail-hover:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease;
}

.progress-bar-animation {
    transition: width 0.1s linear;
}

/* Gallery specific styles */
.gallery-section {
    margin-top: 1rem;
    background-color: white;
    padding: 0 15px;
}

.gallery-grid {
    display: grid;
    gap: 0.5rem;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Desktop view */
@media (min-width: 768px) {
    .gallery-grid {
        display: flex !important;
    }
    
    .main-gallery-image {
        flex: 2;
        height: 430px !important;
        margin-right: 0.5rem;
    }
    
    .secondary-images-wrapper {
        flex: 1;
        display: grid !important;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 0.5rem;
        height: 430px;
    }
    
    .secondary-gallery-image {
        height: calc((430px - 0.5rem) / 2) !important;
    }
}

/* Mobile view */
@media (max-width: 767px) {
    .gallery-section {
        padding: 0;
    }
    .gallery-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 0.5rem;
    }
    
    .main-gallery-image {
        width: 100% !important;
        height: 200px !important;
        margin-bottom: 0.5rem;
        margin-right: 0 !important;
    }
    
    .main-gallery-image .gallery-img {
        border-top-left-radius: 8px !important;
        border-top-right-radius: 8px !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    
    .secondary-images-wrapper {
        width: 100% !important;
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        grid-template-rows: repeat(2, 150px) !important;
        gap: 0.5rem;
        height: auto !important;
    }
    
    .secondary-gallery-image {
        height: 150px !important;
        width: 100% !important;
    }
    
    /* Bottom row border radius settings */
    .secondary-gallery-image:nth-last-child(2) .gallery-img {
        border-bottom-left-radius: 8px !important;
        border-bottom-right-radius: 0 !important;
    }
    
    .secondary-gallery-image:last-child .gallery-img {
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 8px !important;
    }
    
    /* Reset all other borders for middle images */
    .secondary-gallery-image:not(:nth-last-child(-n+2)) .gallery-img {
        border-radius: 0 !important;
    }
}


.main-gallery-image {
    position: relative;
    cursor: pointer;
}

.secondary-gallery-image {
    position: relative;
    cursor: pointer;
}

@media (max-width: 992px) {
    .main-gallery-image {
        height: 200px !important;
    }
    .secondary-gallery-image {
        height: 146px !important;
    }
    .show-all-btn {
        right: 6px !important;
    }
    
.property-details {
     padding-top: 0px !important; 
}

}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 0; /* Reset border radius for all images */
}

.show-all-btn {
    position: absolute;
    bottom: 20px;
    right: 20px;
    z-index: 5;
}

.show-all-btn button {
    background-color: rgba(108, 117, 125, 0.8);
    font-weight: 500;
}

.thumbnail-img {
    width: 100%;
    height: 96px; /* Equivalent to h-24 in Tailwind */
    object-fit: cover;
    border-radius: 8px;
}

.active-thumbnail {
    border: 2px solid #0d6efd; /* Bootstrap primary color */
}

.bg-overlay {
    background-color: rgba(255, 255, 255, 0.2);
}

/* Lightbox styles */
.lightbox-modal {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.95);
    z-index: 1040;
    display: none;
}

.lightbox-progress {
    position: absolute;
    top: 0;
    left: 0;
    height: 4px;
    background-color: #0d6efd; /* Bootstrap primary color */
    z-index: 1010;
    display: none;
}

.lightbox-controls {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1030;
}

/* Thumbnail panel styles */
.thumbnail-panel {
    position: fixed;
    top: 0;
    right: 0;
    height: 100%;
    width: 300px;
    background-color: rgba(33, 37, 41, 0.95); /* Bootstrap dark color with opacity */
    z-index: 1050;
    transition: transform 0.3s ease-in-out;
    overflow-y: auto;
}

.thumbnail-hidden {
    transform: translateX(100%);
}

#thumbnailGrid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
}

.cursor-pointer {
    cursor: pointer;
}

.lightbox-main {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 0 4rem;
}

.lightbox-nav-btn {
    position: absolute;
    color: white;
    cursor: pointer;
    z-index: 20;
}

.lightbox-prev {
    left: 1.5rem;
}

.lightbox-next {
    right: 1.5rem;
}

.lightbox-image-container {
    max-width: 1280px;
    max-height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
}

.thumbnail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
}

.thumbnail-item {
    position: relative;
    cursor: pointer;
}

.thumbnail-active {
    border: 2px solid #3b82f6;
}

/* Share modal */
.share-modal {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 50;
    display: none;
}

.share-modal-content {
    background-color: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    max-width: 28rem;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.share-buttons {
    display: flex;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.share-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    color: white;
    transition: background-color 0.2s;
}

.facebook-btn {
    background-color: #2563eb;
}

.facebook-btn:hover {
    background-color: #1d4ed8;
}

.twitter-btn {
    background-color: #60a5fa;
}

.twitter-btn:hover {
    background-color: #3b82f6;
}

.pinterest-btn {
    background-color: #dc2626;
}

.pinterest-btn:hover {
    background-color: #b91c1c;
}

/* Show all modal */
.show-all-modal {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.95);
    z-index: 40;
    display: none;
    overflow-y: auto;
    padding: 7rem 0 0;
}

.all-images-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.all-images-grid img {
    border-radius: 8px;
}

@media (min-width: 768px) {
    .all-images-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .all-images-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 1280px) {
    .all-images-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

/* Property details styles */
.property-details {
    padding-top: 30px;
}

.gallery-container {
    margin-bottom: 30px;
}

.main-image {
    height: 400px;
    width: 100%;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 15px;
}

.thumbnail-container {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 10px;
}

.thumbnail {
    width: 100px;
    height: 70px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.2s;
}

.thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.property-title {
    color: var(--primary-dark);
    margin-bottom: 15px;
}

.property-location {
    color: var(--secondary-dark);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    font-size: 1.1rem;
}

.property-features {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.feature {
    display: flex;
    align-items: center;
    color: var(--primary-dark);
}

.feature-icon {
    margin-right: 8px;
    color: var(--gold);
}

.price {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gold);
    margin-bottom: 5px;
}

.price-note {
    font-size: 0.9rem;
    color: var(--secondary-dark);
    margin-bottom: 20px;
}

.booking-widget {
    background-color: var(--accent);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    position: sticky;
    top: 20px;
}

.property-details-bg {
    background-color: var(--accent);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.date-input {
    margin-bottom: 15px;
}

.nav-tabs {
    border-bottom: 2px solid var(--secondary-light);
    margin-bottom: 25px;
}

.nav-link {
    color: var(--primary-dark);
    font-weight: 500;
    padding: 10px 20px;
    border: none;
    border-bottom: 3px solid transparent;
    margin-bottom: -2px;
}

.nav-link.active {
    color: var(--gold);
    border-bottom: 3px solid var(--gold);
    background-color: transparent;
}

/* Mobile tabs container and select styling */
.mobile-tab-container {
    display: none;
    margin-bottom: 20px;
}

.mobile-tab-label {
    display: block;
    font-weight: 600;
    color: var(--primary-dark);
    margin-bottom: 8px;
    font-size: 14px;
}

.mobile-tab-select {
    width: 100%;
    padding: 12px;
    border: 1px solid var(--secondary-light);
    border-radius: 8px;
    background-color: white;
    color: var(--primary-dark);
    font-weight: 500;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23143c5d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    padding-right: 36px;
    font-size: 16px;
    transition: all 0.2s ease;
}

.mobile-tab-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px rgba(216, 180, 99, 0.25);
    outline: none;
}

/* Show mobile tabs select only on small screens */
@media (max-width: 767px) {
    .mobile-tab-container {
        display: block;
    }

    .nav-tabs {
        display: none;
    }
}

.amenities-list {
    column-count: 2;
    column-gap: 30px;
}

.amenity-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    break-inside: avoid;
}

.amenity-icon {
    color: var(--gold);
    margin-right: 10px;
}

.map-container {
    height: 300px;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 30px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.reviewer {
    font-weight: 600;
    color: var(--primary-dark);
}

.review-date {
    color: var(--secondary-dark);
    font-size: 0.9rem;
}

.review-stars {
    color: gold;
    margin-bottom: 10px;
}

.review-text {
    color: var(--secondary-dark);
}

/* Apply specific corner roundings */
.left-rounded {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.top-right-rounded {
    border-top-right-radius: 8px;
}

.bottom-right-rounded {
    border-bottom-right-radius: 8px;
}

.property-img {
    border-radius: 10px;
}

/* Additional styles for compatibility with existing site */
.about-owner-section a {
    color: var(--primary-dark);
    text-decoration: none;
}

.about-owner-section a:hover {
    color: var(--gold);
}

/* Make the booking widget sticky */
.booking-widget-container {
    position: sticky;
    top: 100px; /* Adjust based on your header height */
    height: fit-content;
   
}

@media (min-width: 992px) {
    .booking-widget {
        position: sticky;
        top: 100px;
    }

    .booking-widget-container {
        top: 100px;
    }
}

@media (max-width: 991px) {
    .booking-widget-container {
        position: static;
        margin-top: 30px;
    }
}

</style>
        <!-- header End Here -->
    <!-- <div class="banner">
        <div class="c-hero__background">
            <img class="img-fluid" src="{{ $bannerImage }}" title="{{ $name }}" alt="{{ $name }}">
        </div>
        <div class="guides">
            <h1 class="c-hero__title">{{$name}}</h1>
        </div>
    </div> -->

<a href="#book" class="sticky main-btn book1 book-now d-sm-none">
<span class="button-text">BOOK NOW</span>
</a>

<!-- Gallery Component -->
<div class="gallery-section mx-md-3">
    <!-- Main Gallery Section -->
    <div class="container py-4">
        <!-- Image Grid -->
        @php

        @endphp
        <h3 class="fw-bold text-secondary-dark">{{$data->name}}</h3>
        <div class="adr-area" style="margin-bottom: 20px;">
            @if($data->address)
                <h6 class="text-secondary-dark"><i class="fa-solid fa-location-dot text-secondary-dark"></i>{{$data->city}}, {{$data->country}}</h6>
            @endif
        </div>
        <div class="position-relative mb-4">
            <div class="gallery-grid" id="imageGrid">
                <!-- Main large image - left side rounded -->
                <div class="main-gallery-image" onclick="openLightbox(0)">
                    @foreach(App\Models\Lodgify\LodgifyImage::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->limit(1)->skip(0)->get() as $c)
                        <img src="{{($c->url)}}" alt="{{$c->text}}" class="gallery-img left-rounded">
                    @endforeach
                </div>

                <!-- Secondary images in 2x2 grid -->
                <div class="secondary-images-wrapper">
                    @php $i=1; $images = App\Models\Lodgify\LodgifyImage::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->limit(4)->skip(1)->get(); @endphp
                    @foreach($images as $key => $c)
                        <div class="secondary-gallery-image" onclick="openLightbox({{$i}})">
                            <img src="{{($c->url)}}" alt="{{$c->text}}" class="gallery-img {{$key == 1 ? 'top-right-rounded' : ''}} {{$key == 3 ? 'bottom-right-rounded' : ''}}">
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>
            <!-- Show All Button -->
            <div class="show-all-btn">
                <button onclick="openShowAll()" title="Show all photos" class="btn btn-secondary shadow-sm">
                    <span>Show All</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="lightbox-modal">
        <!-- Progress Bar for Slideshow -->
        <div id="progressBar" class="lightbox-progress progress-bar-animation" style="width: 0%"></div>

        <!-- Top Controls -->
        <div class="lightbox-controls">
            <div class="px-2 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center py-2">
                <div class="d-flex align-items-center me-4">
                    <span class="text-white fs-5 fw-medium" id="imageCounter" aria-live="polite">1 / 12</span>
                </div>
                <div class="d-flex align-items-center border border-dark bg-secondary p-2">
                    <button onclick="startSlideshow()" id="slideshowBtn" aria-label="Start slideshow"
                        title="Start slideshow" class="btn btn-sm text-white me-2">
                        <i class="fa-solid fa-play" id="slideshowIcon"></i>
                    </button>
                    <button onclick="toggleThumbnails()" aria-label="Show thumbnails" title="Show thumbnails"
                        class="btn btn-sm text-white me-2">
                        <i class="fa-solid fa-border-all"></i>
                    </button>
                    <button onclick="searchImages()" aria-label="Search images" title="Search images"
                        class="btn btn-sm text-white me-2">
                        <i class="fa-solid fa-search"></i>
                    </button>
                    <button onclick="toggleFullscreen()" aria-label="Toggle fullscreen" title="Toggle fullscreen"
                        class="btn btn-sm text-white me-2">
                        <i class="fa-solid fa-expand" id="fullscreenIcon"></i>
                    </button>
                    <button onclick="openShareModal()" aria-label="Share image" title="Share image"
                        class="btn btn-sm text-white me-2">
                        <i class="fa-solid fa-share-nodes"></i>
                    </button>
                    <button onclick="closeLightbox()" aria-label="Close lightbox" title="Close lightbox"
                        class="btn btn-sm text-white">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Image Container -->
        <div class="lightbox-main">
            <button onclick="previousImage()" aria-label="Previous image" title="Previous image"
                class="lightbox-nav-btn lightbox-prev btn text-white">
                <i class="fa-solid fa-chevron-left fs-2"></i>
            </button>

            <div class="lightbox-image-container">
                <img id="lightboxImage" src="" alt="" class="lightbox-img slideshow-active">
            </div>

            <button onclick="nextImage()" aria-label="Next image" title="Next image"
                class="lightbox-nav-btn lightbox-next btn text-white">
                <i class="fa-solid fa-chevron-right fs-2"></i>
            </button>
        </div>

        <!-- Thumbnail Panel -->
        <div id="thumbnailPanel" class="thumbnail-panel thumbnail-hidden">
            <div class="p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <button onclick="toggleThumbnails()" class="btn btn-sm text-white">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="thumbnail-grid" id="thumbnailGrid">
                    <!-- Thumbnails will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" class="share-modal">
        <div class="share-modal-content">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="fs-5 fw-semibold">Share</h3>
                <button id="copied" class="">
                    <span class="visually-hidden">copied</span>
                </button>
                <button onclick="closeShareModal()" class="btn btn-sm text-secondary">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            <div class="share-buttons">
                <button onclick="shareToFacebook()" class="share-btn facebook-btn">
                    <i class="fa-brands fa-facebook"></i>
                    <span>Facebook</span>
                </button>
                <button onclick="shareToTwitter()" class="share-btn twitter-btn">
                    <i class="fa-brands fa-twitter"></i>
                    <span>Twitter</span>
                </button>
                <button onclick="shareToPinterest()" class="share-btn pinterest-btn">
                    <i class="fa-brands fa-pinterest"></i>
                    <span>Pinterest</span>
                </button>
            </div>

            <div class="border-top pt-3">
                <input type="text" value="{{ url($data->seo_url ?? '') }}" class="form-control mb-2" readonly>
                <button onclick="copyLink()" class="btn btn-dark w-100">
                    Copy Link
                </button>
            </div>
        </div>
    </div>

    <!-- Show All Images Modal -->
    <div id="showAllModal" class="show-all-modal">
        <div class="min-vh-100 p-md-4 p-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="text-white fs-5 fs-md-3 fw-semibold">All Photos - {{$data->name}}</h2>
                <button onclick="closeShowAll()" class="btn btn-dark">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="all-images-grid" id="allImagesGrid">
                <!-- All images will be populated by JavaScript -->
                @foreach(App\Models\Lodgify\LodgifyImage::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->get() as $key => $c)
                    <div class="position-relative">
                        <img src="{{($c->url)}}" alt="{{$c->text}}" class="w-100 rounded" onclick="openLightbox({{$key}})">
                        <p class="text-white mt-2">{{$c->text}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="container property-details">
    <div class="row">
        <div class="col-lg-8 property-details-bg">
            <!-- Property Info -->
            <h1 class="property-title">{{$data->name}}</h1>
            <p class="property-location">
                <span class="iconify me-2" data-icon="mdi:map-marker"></span>
                @if($data->address)
                    {{$data->city}}, {{$data->country}}
                @endif
            </p>

            <div class="property-features">
                @if(($room->max_people))
                <div class="feature">
                    <span class="iconify feature-icon" data-icon="mdi:account-group"></span>
                    <span>{{$room->max_people}} Guests</span>
                </div>
                @endif
                @if(($room->bedrooms))
                <div class="feature">
                    <span class="iconify feature-icon" data-icon="mdi:bed"></span>
                    <span>{{$room->bedrooms}} Bedrooms</span>
                </div>
                @endif
                @if(($room->bathrooms))
                <div class="feature">
                    <span class="iconify feature-icon" data-icon="mdi:shower"></span>
                    <span>{{$room->bathrooms}} Bathrooms</span>
                </div>
                @endif
            </div>

            <div class="price">{{ $currency }} {{$data->original_min_price ?? '0'}} <span style="font-size: 1rem;">/ night</span></div>
            <p class="price-note">Plus cleaning fee and service fee</p>

            <!-- Content Tabs -->
            <!-- Mobile Tab Select Dropdown (visible only on mobile) -->
            <div class="mobile-tab-container">
                <label for="mobileTabs" class="mobile-tab-label">View Property Information</label>
                <select class="mobile-tab-select" id="mobileTabs" aria-label="Select property information section">
                    <option value="description" selected>Description</option>
                    @if(App\Models\Lodgify\LodgifyAmenityGroup::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->count()>0)
                    <option value="amenities">Amenities</option>
                    @endif
                    <option class="d-none" value="location">Location</option>
                    @if(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("id","desc")->count()>0)
                    <option value="reviews">Reviews</option>
                    @endif
                    <option value="availability">Availability</option>
                    @if($data->booking_policy || $data->safety_property || $data->cancellation_policy)
                    <option value="policies">Policies</option>
                    @endif
                </select>
            </div>

            <!-- Desktop Tabs (hidden on mobile) -->
            <ul class="nav nav-tabs" id="propertyTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab">Description</a>
                </li>
                @if(App\Models\Lodgify\LodgifyAmenityGroup::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->count()>0)
                <li class="nav-item">
                    <a class="nav-link" id="amenities-tab" data-bs-toggle="tab" href="#amenities" role="tab">Amenities</a>
                </li>
                @endif
                <li class="nav-item d-none">
                    <a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location" role="tab">Location</a>
                </li>
                @if(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("id","desc")->count()>0)
                <li class="nav-item">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab">Reviews</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="availability-tab" data-bs-toggle="tab" href="#availability" role="tab">Availability</a>
                </li>
                @if($data->booking_policy || $data->safety_property || $data->cancellation_policy)
                <li class="nav-item">
                    <a class="nav-link" id="policies-tab" data-bs-toggle="tab" href="#policies" role="tab">Policies</a>
                </li>
                @endif
            </ul>

            <div class="tab-content" id="propertyTabContent">
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    {!!  $room->description ?? $data->description !!}
                     <h4 class="mb-3 text-secondary-dark">Availability Calendar</h4>
                    <iframe src="{{ url('fullcalendar-demo/'.$data->id) }}" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Amenities Tab -->
                <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
                    <h4 class="mb-4 text-secondary-dark">Cabin Amenities</h4>
                    @if(App\Models\Lodgify\LodgifyAmenityGroup::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->count()>0)
                    <div class="amenities-list">
                        @foreach(App\Models\Lodgify\LodgifyAmenityGroup::where("lodgify_property_id",$data->lodgify_property_id)->orderBy("id","asc")->get() as $c)
                        <div class="amenity-item">
                            <span class="iconify amenity-icon" data-icon="mdi:check-circle"></span>
                            <span>{{ ucfirst($c->text) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Location Tab -->
                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                    <h4 class="mb-3 text-secondary-dark">Location & Nearby Attractions</h4>
                    @if($data->address)
                    <p>{{$data->name}} is located in {{$data->city}}, {{$data->country}}, offering privacy while still being conveniently close to attractions and necessities.</p>
                    @endif

                    @if($data->map)
                    <div class="map-container">
                        <iframe src="{!! $data->map !!}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    @endif
                </div>

                <!-- Availability Tab -->
                <div class="tab-pane fade" id="availability" role="tabpanel" aria-labelledby="availability-tab">
                    <h4 class="mb-3 text-secondary-dark">Availability Calendar</h4>
                    <iframe src="{{ url('fullcalendar-demo/'.$data->id) }}" width="100%" height="400" style="border:0;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Policies Tab -->
                <div class="tab-pane fade" id="policies" role="tabpanel" aria-labelledby="policies-tab">
                    <div id="policies" class="section-container">
                        <h4 class="textColor fw-bold mb-4">Things to know</h4>
                        <div class="row">
                            @if($data->booking_policy!="")
                            <div class="col-lg-12 rule card mb-3">
                                <div class="area card-body">
                                    <h4 class="main textColor fw-bold">House Rules</h4>
                                    <div class="rules-short">{!! $data->booking_policy !!}</div>
                                </div>
                            </div>
                            @endif

                            @if($data->safety_property!="")
                            <div class="col-lg-12 safety card mb-3">
                                <div class="area card-body">
                                    <h4 class="main textColor fw-bold">Safety &amp; Property</h4>
                                    <div class="safety-short">
                                        {!! $data->safety_property !!}
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($data->cancellation_policy!="")
                            <div class="cancel card mb-3 col-lg-12">
                                <div class="area card-body">
                                    <h4 class="main textColor fw-bold">Cancellation policy</h4>
                                    <div class="cancellation-short" style="display: block;">{!! $data->cancellation_policy !!}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 text-secondary-dark">Guest Reviews</h4>
                    </div>

                    <!-- Sample Reviews -->
                    @foreach(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("id","desc")->get() as $c)
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer">{{$c->name}}</div>
                            <div class="review-date">
                                @if($c->stay_date)
                                    {{date('F Y',strtotime($c->stay_date))}}
                                @endif
                            </div>
                        </div>
                        <div class="review-stars">
                            <span class="iconify" data-icon="mdi:star"></span>
                            <span class="iconify" data-icon="mdi:star"></span>
                            <span class="iconify" data-icon="mdi:star"></span>
                            <span class="iconify" data-icon="mdi:star"></span>
                            <span class="iconify" data-icon="mdi:star"></span>
                        </div>
                        <div class="review-text">
                            <p>{{$c->message}}</p>
                        </div>
                    </div>
                    @endforeach

                    @if(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->count() > 3)
                    <button class="btn btn-secondary-dark mt-3" data-bs-toggle="modal" data-bs-target="#rvw">Load More Reviews</button>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 booking-widget-container" id="book">
            <!-- Booking Widget -->
          <div class="booking-widget" >
                        <div class='side-area'>
                            <div class="upper-area">
                        <div class="price">
                            @if($data->original_min_price)
                                    <p>{{ $currency }}  {{$data->original_min_price}}</p>
                                    <span>/ night</span>
                              @endif
                            </div>

                        </div>
                        <div class="error-box d-none" id="webdesignstr-error-show-parent">
                            <p id="webdesignstr-error-show-p"></p>
                        </div>
                        <div class="get-quote">
                        <div class="contact-box">
                                <form class="form booking_form" id="booking_form" action="{{url('get-quote')}}" method="get">
                                    <input type="hidden" name="property_id" value="{{ $data->id }}">
                                       <div class="main-cal">
                                            <div class="ovabrw_datetime_wrapper">
                                                 {!! Form::text("start_date",Request::get("start_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"start_date","placeholder"=>"Check in"]) !!}
                                                 <i class="fa-solid fa-calendar-days"></i>
                                            </div>
                                            <div class="ovabrw_datetime_wrapper">
                                                 {!! Form::text("end_date",Request::get("end_date"),["required","autocomplete"=>"off","inputmode"=>"none","id"=>"end_date","placeholder"=>"Check Out"]) !!}
                                                 <i class="fa-solid fa-calendar-days"></i>
                                            </div>
                                           <input type="text" id="demo17" value="" aria-label="Check-in and check-out dates" aria-describedby="demo17-input-description" readonly/>
                                       </div>

                                    <div class="ovabrw_service_select rental_item">
                                            <input type="text" name="Guests"   value="{{ Request::get('Guests') ?? '' }}" readonly="" class="form-control gst" id="show-target-data" placeholder="Guests" title="Choose no. of guests">
                                             <i class="fa-solid fa-users "></i>
                                             <input type="hidden" value="{{ Request::get('adults') ?? '0' }}"  name="adults" id="adults-data" />
                                             <input type="hidden" value="{{ Request::get('child') ?? '0' }}"  name="child" id="child-data" />
                                             <div class="adult-popup" id="guestsss">
                                                 <i class="fa fa-times close1"></i>
                                                 <div class="adult-box">
                                                     <p id="adults-data-show"><span>@if(Request::get('adults'))
                                                                                         @if(Request::get('adults')>1)
                                                                                             {{ Request::get('adults') }} Adults
                                                                                         @else
                                                                                             {{ Request::get('adults') }} Adult
                                                                                         @endif
                                                                                      @else
                                                                                      Adult
                                                                                      @endif</span> 18+</p>
                                                     <div class="adult-btn">
                                                         <button class="button1"  type="button" onclick="functiondec('#adults-data','#show-target-data','#child-data')" value="Decrement Value">-</button>
                                                         <button class="button11 button1" type="button"  onclick="functioninc('#adults-data','#show-target-data','#child-data')" value="Increment Value">+</button>
                                                     </div>
                                                 </div>
                                                 <div class="adult-box">
                                                     <p id="child-data-show"><span>@if(Request::get('child'))
                                                                                         @if(Request::get('child')>1)
                                                                                             {{ Request::get('child') }} Children
                                                                                         @else
                                                                                             {{ Request::get('child') }} Child
                                                                                         @endif
                                                                                      @else
                                                                                      Child
                                                                                      @endif</span> (0-17)</p>
                                                     <div class="adult-btn">
                                                         <button class="button1" type="button"  onclick="functiondec('#child-data','#show-target-data','#adults-data')" value="Decrement Value">-</button>
                                                         <button class="button11 button1" type="button"  onclick="functioninc('#child-data','#show-target-data','#adults-data')" value="Increment Value">+</button>
                                                     </div>
                                                 </div>
                                                 <button class="main-btn  close111" type="button" onclick="">Apply</button>
                                             </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ovabrw-book-now" id="submit-button-webdesignstr-data" style="display: none;">
                                                <button type="submit" class="main-btn">
                                                <span> Reserve</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="webdesignstr-new-data-area"></div>
                                </form>
                                 <div class="text-center about-owner-section">
                                <p>Or<br>Contact Owner</p>
                                <p><a href="mailto:{{$data->email ?? $setting_data['email'] }}"><i class="fa-solid fa-envelope"></i> {{$data->email ?? $setting_data['email'] }}</a></p>
                                <p><a href="mailto:{{$data->mobile ?? $setting_data['mobile'] }}"><i class="fa-solid fa-phone"></i> {{$data->mobile ?? $setting_data['mobile'] }}</a></p>
                            </div>
                        </div>
                    </div>

                         </div>
                    </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="rvw">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4>What people think about us</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="rvw-area">
                    @foreach(App\Models\Testimonial::where("property_id",$data->id)->where("status","true")->orderBy("id","desc")->get() as $c)
                        <div class="review-box">
                            <div class="guest-profile">
                                @if($c->image)
                                    <img src="{{ asset($c->image)}}" alt="{{$data->name}} -- {{$c->name}}" class="">
                                @else
                                    <img src="{{ asset('front')}}/images/misty.webp" alt="{{$data->name}} -- {{$c->name}}" class="">
                                @endif
                                <div class="prof">
                                    <p>{{$c->name}}</p>
                                    @if($c->stay_date)
                                        <span>{{date('F-d Y',strtotime($c->stay_date))}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="guest-content">
                                <p>{{$c->message}}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal for Additional Fee -->
<div class="modal" id="myModal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Additional Fee</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="webdesignstr-new-modal-service-area">
                Modal body..
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal for Days -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Days</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" id="webdesignstr-new-modal-days-area">
                Modal body..
            </div>
        </div>
    </div>
</div>

@stop
@section("css")
    @parent
    <link rel="stylesheet" href="{{ asset('front')}}/assets/fancybox/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ asset('front')}}/css/property-detail.css" />
    <link rel="stylesheet" href="{{ asset('front')}}/css/property-detail-responsive.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('datepicker') }}/dist/css/hotel-datepicker.css"/>
    <link rel="stylesheet" href="{{ asset('front')}}/css/datepicker.css" />
     <style>
        /* Additional styles for dynamic property page */
        .booking-widget {
            position: -webkit-sticky;
            position: sticky;
            top: 100px;
        }
     </style>
@stop
@section("js")
    @parent
    <script src="{{ asset('front')}}/assets/fancybox/jquery.fancybox.min.js" ></script>
    <script src="{{ asset('front')}}/js/property-detail.js" ></script>

    <script>
    // Gallery Component JavaScript
    let images = [];

    // Load images from the backend into our images array
    document.addEventListener('DOMContentLoaded', function() {
        // Find all gallery images and populate the images array
        const imageGrid = document.getElementById('imageGrid');
        if (imageGrid) {
            const imgElements = imageGrid.querySelectorAll('img.gallery-img');
            imgElements.forEach(img => {
                images.push({
                    src: img.src,
                    alt: img.alt
                });
            });
        }
    });

    let currentImageIndex = 0;
    let isSlideshow = false;
    let slideshowInterval;
    let isFullscreen = false;
    let thumbnailsVisible = false;

    function openLightbox(index) {
        currentImageIndex = index;
        document.getElementById('lightboxModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
        updateLightboxImage();
        populateThumbnails();
    }

    function closeLightbox() {
        document.getElementById('lightboxModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        stopSlideshow();
        exitFullscreen();
    }

    function updateLightboxImage() {
        const lightboxImage = document.getElementById('lightboxImage');
        lightboxImage.src = images[currentImageIndex].src;
        lightboxImage.alt = images[currentImageIndex].alt;
        document.getElementById('imageCounter').textContent = `${currentImageIndex + 1} / ${images.length}`;

        // Update active thumbnail
        updateActiveThumbnail();
    }

    function nextImage() {
        const lightboxImage = document.getElementById('lightboxImage');
        // Remove the current class to reset animation
        lightboxImage.classList.remove('slideshow-active');
        // Force reflow
        void lightboxImage.offsetWidth;

        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateLightboxImage();

        // Add animation class
        lightboxImage.classList.add('slideshow-active');
    }

    function previousImage() {
        const lightboxImage = document.getElementById('lightboxImage');
        // Remove the current class to reset animation
        lightboxImage.classList.remove('slideshow-active');
        // Force reflow
        void lightboxImage.offsetWidth;

        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateLightboxImage();

        // Add animation class
        lightboxImage.classList.add('slideshow-active');
    }

    function startSlideshow() {
        if (!isSlideshow) {
            isSlideshow = true;
            document.getElementById('slideshowIcon').classList.remove('fa-play');
            document.getElementById('slideshowIcon').classList.add('fa-pause');

            document.getElementById('progressBar').style.display = 'block';

            let progress = 0;
            const progressBar = document.getElementById('progressBar');
            const slideDuration = 3000; // 3 seconds per slide
            const updateInterval = 20; // Update every 20ms for smoother animation
            const increment = (updateInterval / slideDuration) * 100;

            slideshowInterval = setInterval(() => {
                progress += increment;
                progressBar.style.width = `${progress}%`;

                if (progress >= 100) {
                    progress = 0;
                    progressBar.style.width = '0%';
                    // Add fadeOut class to current image
                    const lightboxImage = document.getElementById('lightboxImage');
                    lightboxImage.classList.add('slideshow-active');
                    nextImage();
                    // Remove fadeOut class after animation completes
                    setTimeout(() => {
                        lightboxImage.classList.remove('slideshow-active');
                    }, 500);
                }
            }, updateInterval);
        } else {
            stopSlideshow();
        }
    }

    function stopSlideshow() {
        isSlideshow = false;
        clearInterval(slideshowInterval);
        document.getElementById('slideshowIcon').classList.remove('fa-pause');
        document.getElementById('slideshowIcon').classList.add('fa-play');
        document.getElementById('progressBar').style.display = 'none';
        document.getElementById('progressBar').style.width = '0%';
    }

    function toggleFullscreen() {
        if (!isFullscreen) {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            }
            document.getElementById('fullscreenIcon').classList.remove('fa-expand');
            document.getElementById('fullscreenIcon').classList.add('fa-compress');
            isFullscreen = true;
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
            document.getElementById('fullscreenIcon').classList.remove('fa-compress');
            document.getElementById('fullscreenIcon').classList.add('fa-expand');
            isFullscreen = false;
        }
    }

    function exitFullscreen() {
        if (isFullscreen && document.exitFullscreen) {
            document.exitFullscreen();
            document.getElementById('fullscreenIcon').classList.remove('fa-compress');
            document.getElementById('fullscreenIcon').classList.add('fa-expand');
            isFullscreen = false;
        }
    }

    function toggleThumbnails() {
        const panel = document.getElementById('thumbnailPanel');
        if (!thumbnailsVisible) {
            panel.classList.remove('thumbnail-hidden');
            thumbnailsVisible = true;
        } else {
            panel.classList.add('thumbnail-hidden');
            thumbnailsVisible = false;
        }
    }

    function populateThumbnails() {
        const thumbnailGrid = document.getElementById('thumbnailGrid');
        thumbnailGrid.innerHTML = '';

        images.forEach((image, index) => {
            const thumbnailDiv = document.createElement('div');
            thumbnailDiv.className = 'position-relative cursor-pointer thumbnail-hover';
            thumbnailDiv.onclick = () => selectThumbnail(index);
            thumbnailDiv.innerHTML = `
                    <img src="${image.src}" alt="${image.alt}" class="w-100 thumbnail-img rounded ${index === currentImageIndex ? 'active-thumbnail' : ''}">
                    ${index === currentImageIndex ? '<div class="position-absolute top-0 start-0 w-100 h-100 bg-overlay rounded"></div>' : ''}
                `;
            thumbnailGrid.appendChild(thumbnailDiv);
        });
    }

    function selectThumbnail(index) {
        currentImageIndex = index;
        updateLightboxImage();
    }

    function updateActiveThumbnail() {
        const thumbnails = document.querySelectorAll('#thumbnailGrid > div');
        thumbnails.forEach((thumb, index) => {
            const img = thumb.querySelector('img');
            const overlay = thumb.querySelector('div');
            if (index === currentImageIndex) {
                img.classList.add('active-thumbnail');
                if (!overlay) {
                    thumb.innerHTML += '<div class="position-absolute top-0 start-0 w-100 h-100 bg-overlay rounded"></div>';
                }
            } else {
                img.classList.remove('active-thumbnail');
                if (overlay) {
                    overlay.remove();
                }
            }
        });
    }

    function openShareModal() {
        const modal = document.getElementById('shareModal');
        modal.style.display = 'flex';
        modal.classList.add('d-flex', 'align-items-center', 'justify-content-center');
    }

    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        modal.style.display = 'none';
        modal.classList.remove('d-flex', 'align-items-center', 'justify-content-center');
    }

    function shareToFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    }

    function shareToTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Check out this amazing property!');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
    }

    function shareToPinterest() {
        const url = encodeURIComponent(window.location.href);
        const description = encodeURIComponent('Amazing property');
        const media = encodeURIComponent(images[currentImageIndex].src);
        window.open(`https://pinterest.com/pin/create/button/?url=${url}&description=${description}&media=${media}`, '_blank', 'width=600,height=400');
    }

    async function copyLink() {
        const input = document.querySelector('#shareModal input');
        const text = input.value;

        try {
            // Use modern Clipboard API if available
            if (navigator.clipboard && navigator.clipboard.writeText) {
                await navigator.clipboard.writeText(text);
            } else {
                // Fallback to older method
                input.select();
                document.execCommand('copy');
            }

            const button = document.getElementById('copied');
            button.textContent = 'Copied!';
            button.classList.add('bg-success', 'text-white', 'px-3', 'py-1', 'rounded');
            button.classList.remove('bg-dark');

            setTimeout(() => {
                button.textContent = '';
                button.classList.remove('bg-success');
                button.innerHTML = '<span class="visually-hidden">copied</span>';
            }, 2000);
        } catch (err) {
            console.error('Failed to copy: ', err);
            alert('Failed to copy link. Please try selecting and copying manually.');
        }
    }

    function searchImages() {
        alert('Search functionality would be implemented here!');
    }

    function openShowAll() {
        const modal = document.getElementById('showAllModal');
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeShowAll() {
        document.getElementById('showAllModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Keyboard navigation handler
    function handleKeyDown(e) {
        const lightboxModal = document.getElementById('lightboxModal');
        if (lightboxModal && lightboxModal.style.display === 'none') return;

        switch (e.key) {
            case 'ArrowLeft':
                previousImage();
                break;
            case 'ArrowRight':
            case ' ':
                e.preventDefault();
                nextImage();
                break;
            case 'Escape':
                closeLightbox();
                break;
            case 'f':
            case 'F':
                toggleFullscreen();
                break;
        }
    }

    // Fullscreen change handler
    function handleFullscreenChange() {
        isFullscreen = !!document.fullscreenElement;
        if (isFullscreen) {
            document.getElementById('fullscreenIcon').classList.remove('fa-expand');
            document.getElementById('fullscreenIcon').classList.add('fa-compress');
        } else {
            document.getElementById('fullscreenIcon').classList.remove('fa-compress');
            document.getElementById('fullscreenIcon').classList.add('fa-expand');
        }
    }

    // Function to handle mobile tab functionality
    function setupMobileTabs() {
        const mobileTabSelect = document.getElementById('mobileTabs');
        if (!mobileTabSelect) return;

        // Initialize mobile select value to match the active tab
        const activeTabLink = document.querySelector('.nav-link.active');
        if (activeTabLink) {
            const activeTabId = activeTabLink.getAttribute('href').substring(1);
            mobileTabSelect.value = activeTabId;
        }

        // Handle mobile tab selection change
        mobileTabSelect.addEventListener('change', function() {
            const selectedTabId = this.value;

            // Find the corresponding tab link
            const tabToActivate = document.querySelector(`.nav-link[href="#${selectedTabId}"]`);
            if (tabToActivate) {
                // Use Bootstrap's tab API to show the selected tab
                const bsTab = new bootstrap.Tab(tabToActivate);
                bsTab.show();
            }
        });

        // Update mobile select when desktop tabs change
        const tabLinks = document.querySelectorAll('.nav-link');
        tabLinks.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function(event) {
                const activeTabId = event.target.getAttribute('href').substring(1);
                mobileTabSelect.value = activeTabId;
            });
        });
    }

    // Initialize everything when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Set up event listeners for keyboard navigation
        window.addEventListener('keydown', handleKeyDown);
        document.addEventListener('fullscreenchange', handleFullscreenChange);

        // Make sure thumbnailPanel starts hidden
        const thumbnailPanel = document.getElementById('thumbnailPanel');
        if (thumbnailPanel) {
            thumbnailPanel.classList.add('thumbnail-hidden');
        }

        // Initialize the mobile tabs
        setupMobileTabs();
    });
</script>
  <script>
    function functiondec($getter_setter,$show,$cal){
      $("#submit-button-webdesignstr-data").hide();
        val=parseInt($($getter_setter).val());
        if(val>0){
            val=val-1;
        }
        $($getter_setter).val(val);
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
        ajaxCallingData();
    }
    function functioninc($getter_setter,$show,$cal){
      $("#submit-button-webdesignstr-data").hide();
        val=parseInt($($getter_setter).val());

        person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;


                val=val+1;


             person1=val;
        person2=parseInt($($cal).val());
        $show_data=person1+person2;


        $($getter_setter).val(val);
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
        ajaxCallingData();
    }
</script>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Days</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="webdesignstr-new-modal-days-area">
        Modal body..
      </div>

    </div>
  </div>
</div>



<!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Additional Fee</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="webdesignstr-new-modal-service-area">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script>
    const roomId = "{{$room_id}}";

     function clearDataForm(){
        $("#start_date").val('');
        $("#end_date").val('');

        $("#submit-button-webdesignstr-data").hide();
        $("#webdesignstr-new-modal-days-area").html('');
        $("#webdesignstr-new-modal-service-area").html('');
        $("#webdesignstr-new-data-area").html('');

    }

    $(document).on("change","#pet_fee_data_webdesignstr",function(){
        ajaxCallingData();
    });
    $(document).on("change","#heating_pool_fee_data_webdesignstr",function(){
        ajaxCallingData();
    });

    function ajaxCallingData(){
        pet_fee_data_webdesignstr=0;
        heating_pool_fee_data_webdesignstr=0;
        adults=$("#adults-data").val();
        childs=$("#child-data").val();
        console.log({start_date:$("#start_date").val(),end_date:$("#end_date").val(),heating_pool_fee_data_webdesignstr:heating_pool_fee_data_webdesignstr,pet_fee_data_webdesignstr:pet_fee_data_webdesignstr,adults:adults,childs:childs,book_sub:true,property_id:roomId});
        total_guests=parseInt(adults)+parseInt(childs);
        if(total_guests>0){
             if($("#end_date").val()!=""){
                 if($("#start_date").val()!=""){
                     $.post("{{route('checkajax-get-quote')}}",{start_date:$("#start_date").val(),end_date:$("#end_date").val(),heating_pool_fee_data_webdesignstr:heating_pool_fee_data_webdesignstr,pet_fee_data_webdesignstr:pet_fee_data_webdesignstr,adults:adults,childs:childs,book_sub:true,property_id:roomId},function(data){
                        if(data.status==400){

                            $("#webdesignstr-new-modal-days-area").html(null);
                            $("#webdesignstr-new-modal-service-area").html(null);
                            $("#webdesignstr-new-data-area").html(null);
                            $("#submit-button-webdesignstr-data").hide();
                            toastr.error(data.message);
                        }else{
                            $("#submit-button-webdesignstr-data").show();
                            $("#webdesignstr-new-modal-days-area").html(data.modal_day_view);
                            $("#webdesignstr-new-modal-service-area").html(data.modal_service_view);
                            $("#webdesignstr-new-data-area").html(data.data_view);
                        }
                    });
                 }
             }
        }else{
            $("#webdesignstr-new-modal-days-area").html(null);
            $("#webdesignstr-new-modal-service-area").html(null);
            $("#webdesignstr-new-data-area").html(null);
            $("#submit-button-webdesignstr-data").hide();
        }

    }
    </script>
            <script src="{{ asset('datepicker') }}/node_modules/fecha/dist/fecha.min.js"></script>
        <script src="{{ asset('datepicker') }}/dist/js/hotel-datepicker.js"></script>
    <script>

    @php
    $new_data_blocked=LiveCart::iCalDataCheckInCheckOutCheckinCheckout($data->id);



    $checkin=json_encode($new_data_blocked['checkin']);

    $checkout=json_encode($new_data_blocked['checkout']);
    $blocked=json_encode($new_data_blocked['blocked']);

@endphp

      var checkin = <?php echo $checkin;  ?>;
    var checkout = <?php echo ($checkout);  ?>;
    var blocked= <?php echo ($blocked);  ?>;
            (function () {


                // ------------------- DEMO 17 ------------------- //


                        @if(Request::get("start_date"))
                            @if(Request::get("end_date"))

                                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}")


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
                                    ajaxCallingData();
                                }

                        },
                        clearButton:function(){

                            return true;
                        },





                    }
                );




                        @if(Request::get("start_date"))
                            @if(Request::get("end_date"))
                                setTimeout(function(){
                                        $("#demo17").val("{{ request()->start_date }} - {{ request()->end_date }}")
                                        document.getElementById("start_date").value ="{{ request()->start_date }}";
                                        document.getElementById("end_date").value ="{{ request()->end_date }}";
                                           ajaxCallingData();
                                    },1000);

                            @endif
                        @endif

                // abc.addEventListener(
                //     "afterClose",
                //     function () {
                //         console.log("hi")
                //     },
                //     false
                // );




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
@stop
