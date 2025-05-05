@extends('frontend.layouts.pages-layout')
@section('pageTitle', $pageTitle ?? 'Page Title Here')
@section('content')
    <div class="title_box text-center pb-md-0 pb-5 mb-5">
        <h2>Best Desktop App for You</h2>
        <p class="color4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <div class="buttons_blk">
            <a href="#" class="btn btn-custom btn-2">Download</a>
            <a href="#" class="btn btn-custom btn-3">Free Trial</a>
        </div>
    </div>

    <div class="section-news">
        <div class="container">
            <div class="title_box mb-5">
                <h2>Полезная информация</h2>
            </div>
            <div class="row">
                @if(!empty($firstPost))
                <div class="col-lg-6">
                    <div class="news_general">
                        <div class="text-center img">
                            <a href="#"><img src="/images/posts/{{$firstPost['featured_image']}}" alt="{{$firstPost['title']}}" class="img-fluid"></a>
                        </div>
                        <div class="mt-4">
                            <h4><a href="#">{{$firstPost['title']}}</a></h4>
                        </div>
                        <div class="mt-4">
                            <p>
                                {{$firstPost['content']}}
                            </p>
                        </div>
                        <div class="link">
                            <a href="#" class="arrow_link">
                                Continue Reading
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-6">
                    @if(!empty($posts))
                        @foreach($posts as $item)
                            <div class="news_box mb-5">
                                <div class="row">
                                    <div class="col-md-4 img"><a href="#"><img src="/images/posts/{{$item['featured_image']}}" alt="{{$item['title']}}" alt="new1" class="img-fluid"></a></div>
                                    <div class="col-md-8 desc">
                                        <h5>{{$item['title']}}</h5>
                                        <p class="mt-2">
                                            {{$item['content']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
