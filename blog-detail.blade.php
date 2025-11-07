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
        $name = $data->title;
        $bannerImage = 'https://ga4prozbj7-flywheel.netdna-ssl.com/wp-content/themes/aspenhomes/dist/images/trees-bg-600x350.jpg';
        if($data->image){
            $bannerImage = asset($data->image);
        }
        $category = App\Models\Blogs\BlogCategory::where("id", $data->blog_category_id)->first();
    @endphp

<style>
    :root {
        --primary-dark: #152435;
        --primary-light: #F7F7F7;
        --secondary-dark: #043A66;
        --secondary-light: #BFD0DE;
        --accent: #F1FBFF;
        --gold: #EFAD29;
        --text-white: #ffffff;
        --text-black: #212529;
        --primary-font: 'Inter', sans-serif;
        --secondary-font: 'Poppins', sans-serif;
    }

    body {
        font-family: var(--primary-font);
        background-color: var(--primary-light);
        color: var(--text-black);
        margin: 0;
        padding: 0;
    }

    .blog-detail-wrapper {
        background-color: var(--primary-light);
        padding: 25px 0 70px 0;
    }

    .blog-detail-image {
        position: relative;
        margin-bottom: 20px;
    }

    .blog-detail-image img {
        width: 100%;
        height: 370px;
        max-height: 370px;
        object-fit: cover;
        border-radius: 10px;
    }

    .blog-detail-cat {
        font-size: 16px;
        font-weight: 400;
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: var(--gold);
        padding: 5px 23px;
        border-radius: 50px;
        color: var(--text-black);
        box-shadow: 0px 0px 10px rgba(239, 173, 41, 0.3);
    }

    .blog-detail-cat a {
        color: var(--text-black);
        text-decoration: none;
    }

    .blog-detail-title h3.heading {
        color: var(--text-black) !important;
        font-size: 33px;
        margin-top: 10px;
        font-weight: 600;
        margin-bottom: 15px;
        font-family: var(--secondary-font);
    }

    .feat_blog_con p {
        margin-bottom: 20px;
    }

    .feat_blog_con p span {
        color: var(--secondary-light);
        font-size: 15px;
        margin-right: 17px;
        font-weight: 400;
    }

    .feat_blog_con p span a {
        color: var(--gold);
        font-size: 15px;
        margin-right: 17px;
        font-weight: 400;
        text-decoration: none;
    }

    .icon_theme {
        color: var(--gold) !important;
    }

    .blod-detail-description {
        margin-top: 13px;
    }

    .blod-detail-description p {
        color: var(--text-black);
        text-align: justify;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .blod-detail-description h2 {
        color: var(--gold) !important;
        font-size: 29px;
        margin-top: 30px;
        font-weight: 600;
        margin-bottom: 15px;
        font-family: var(--secondary-font);
    }

    .blod-detail-description h3 {
        color: var(--gold) !important;
        font-size: 26px;
        margin-top: 25px;
        font-weight: 600;
        margin-bottom: 15px;
        font-family: var(--secondary-font);
    }

    .blod-detail-description h4 {
        color: var(--secondary-light);
        font-size: 22px;
        margin-top: 20px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .blod-detail-description img {
        width: 100%;
        border-radius: 10px;
        margin: 20px 0;
    }

    .widget {
        padding: 20px;
        background-color: var(--secondary-dark) !important;
        border-radius: 10px;
        position: relative;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
        border: 1px solid rgba(191, 208, 222, 0.1);
    }

    h2.widget-title {
        font-size: 26px;
        padding-bottom: 18px;
        margin-bottom: 30px;
        position: relative;
        color: var(--gold);
        font-weight: 700;
        text-transform: capitalize;
        font-family: var(--secondary-font);
    }

    .widget-title:after {
        position: absolute;
        content: '';
        width: 63px;
        height: 2px;
        background-color: var(--gold);
        bottom: 6px;
        left: 0;
    }

    .widget ul {
        margin: 0;
        padding-left: 0;
        list-style-type: none;
    }

    .widget ol li, .widget ul li {
        padding: 0.72rem 0;
        border-bottom: 1px solid rgba(191, 208, 222, 0.2);
        border-top: 1px solid rgba(191, 208, 222, 0.2);
        list-style-type: none;
        padding-left: 0;
        display: flex;
        justify-content: space-between;
    }

    .widget ol li:first-child, .widget ul li:first-child {
        border-top: none;
        padding-top: 0;
    }

    .widget_categories li a {
        color: var(--text-white) !important;
        display: flex;
        font-size: 15px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .widget_categories li a:hover {
        color: var(--gold) !important;
    }

    .widget_categories li span {
        color: var(--secondary-light) !important;
    }

    .widget_recent_entries img {
        margin-right: 17px;
        height: 74px;
        max-width: 75px;
        display: block;
        object-fit: cover;
        border-radius: 10px;
    }

    .widget_recent_entries li.item-recent-post {
        display: flex;
        align-items: flex-start;
    }

    .widget_recent_entries li.item-recent-post .title-post {
        display: flex;
        flex-direction: column;
        width: 76%;
    }

    .widget_recent_entries li.item-recent-post a {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
        max-height: 2.6em;
        margin-bottom: 0.5em;
        font-size: 17px;
        color: var(--text-white);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .widget_recent_entries li.item-recent-post a:hover {
        color: var(--gold);
    }

    .widget_recent_entries .post-date {
        display: block;
        font-size: 14px !important;
        color: var(--secondary-light);
        text-transform: uppercase;
    }

    .highlight-box {
        background-color: var(--secondary-light);
        border-left: 4px solid var(--gold);
        padding: 20px;
        margin: 25px 0;
        border-radius: 0 10px 10px 0;
    }

    .activity-list {
        background-color: rgba(4, 58, 102, 0.3);
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
    }

    .activity-list ul {
        list-style: none;
        padding-left: 0;
    }

    .activity-list ul li {
        padding: 8px 0;
        border-bottom: 1px solid rgba(191, 208, 222, 0.2);
        position: relative;
        padding-left: 25px;
    }

    .activity-list ul li:before {
        content: "→";
        color: var(--gold);
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    .activity-list ul li:last-child {
        border-bottom: none;
    }

    .pro-tip {
        background: linear-gradient(135deg, var(--gold) 0%, #f4b942 100%);
        color: var(--primary-dark);
        padding: 20px;
        border-radius: 10px;
        margin: 25px 0;
        font-weight: 500;
    }

    .pro-tip strong {
        color: var(--primary-dark);
    }

    @media (max-width: 768px) {
        .blog-detail-wrapper {
            padding: 100px 0 50px 0;
        }
        
        .blog-detail-title h3.heading {
            font-size: 24px;
        }
        
        .widget {
            margin-bottom: 20px;
        }
        
        .blog-detail-image {
            margin-bottom: 15px;
        }
        
        .blog-detail-image img {
            height: 250px;
        }
    }

    @media (max-width: 576px) {
        .feat_blog_con p span {
            display: block;
            margin-bottom: 10px;
        }
    }
</style>

<section class="blog-detail-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-detail-left">
                    <div class="blog-detail-image">
                        <img src="{{ asset($data->featureImage) }}" alt="{{ $name }}">
                        @if($category)
                        <div class="blog-detail-cat">
                            <a href="{{ url('blogs/category/'.$category->seo_url) }}/">{{ $category->title }}</a>
                        </div>
                        @endif
                    </div>
                    
                    <div class="blog-detail-title">
                        <h3 class="heading">{{ $name }}</h3>
                    </div>
                    
                    <div class="feat_blog_con">
                        <p>
                            <span class="icon_theme">
                                <i class="fas fa-calendar-alt icon_theme" aria-hidden="true"></i> 
                                {{ date('d M Y', strtotime($data->created_at)) }}
                            </span>
                            &nbsp;&nbsp;
                            @if($category)
                            <span>
                                <i class="fas fa-globe icon_theme" aria-hidden="true"></i>
                                <a href="{{ url('blogs/category/'.$category->seo_url) }}/" class="icon_theme">{{ $category->title }}</a>
                            </span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="blod-detail-description mb-5">
                        {!! $data->longDescription !!}
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <section class="widget widget_categories">
                    <h2 class="widget-title">Categories</h2>
                    <ul>
                        @foreach(App\Models\Blogs\BlogCategory::orderBy("id","desc")->get() as $cat)
                        <li class="cat-item">
                            <a href="{{ url('blogs/category/'.$cat->seo_url) }}/">{{ $cat->title }}</a> 
                            <span>({{ App\Models\Blogs\Blog::where("blog_category_id",$cat->id)->count() }})</span>
                        </li>
                        @endforeach
                    </ul>
                </section>
                
                <section class="widget widget_recent_entries">
                    <h2 class="widget-title">Recent Posts</h2>
                    <ul>
                        @foreach(App\Models\Blogs\Blog::where("id","!=",$data->id)->orderBy("id","desc")->take(5)->get() as $b)
                        <li class="item-recent-post">
                            <div class="thumbnail-post">
                                <img src="{{ asset($b->featureImage) }}" alt="{{ $b->title }}">
                            </div>
                            <div class="title-post">
                                <a href="{{ url('blog/'.$b->seo_url) }}/">{{ $b->title }}</a>
                                <span class="post-date icon_theme">
                                    <i class="far fa-calendar-check" aria-hidden="true"></i> 
                                    {{ date('d M Y', strtotime($b->created_at)) }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>
            </div>
        </div>
    </div>
</section>

@stop
@section("css")
    @parent
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@stop 
@section("js")
    @parent
@stop