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

    <div class="section-7">
        <div class="title_box text-center">
            <h2>Latest News From Us</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5">
                    <div class="news_general">
                        <div class="text-center">
                            <a href="#"><img src="img/news/image1.jpg" alt="new1" class="img-fluid"></a>
                        </div>
                        <div class="mt-4">
                            <h4><a href="#">The master bedroom suite is phenomenally spacious</a></h4>
                        </div>
                        <div class="mt-4">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                        <div class="link">
                            <a href="#" class="arrow_link">
                                Continue Reading
                                &nbsp;
                                <svg width="68" height="16" viewBox="0 0 68 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M67.7071 8.70711C68.0976 8.31658 68.0976 7.68342 67.7071 7.29289L61.3431 0.928932C60.9526 0.538408 60.3195 0.538408 59.9289 0.928932C59.5384 1.31946 59.5384 1.95262 59.9289 2.34315L65.5858 8L59.9289 13.6569C59.5384 14.0474 59.5384 14.6805 59.9289 15.0711C60.3195 15.4616 60.9526 15.4616 61.3431 15.0711L67.7071 8.70711ZM0 9H67V7H0V9Z" fill="#0063DD"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="news_box mt-5">
                        <div class="img"><a href="#"><img src="img/news/image2.jpg" alt="new1" class="img-fluid"></a></div>
                        <div class="desc">
                            <h5>The master bedroom suite is phenomeny spacious</h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                            </p>
                        </div>
                    </div>
                    <div class="news_box mt-4">
                        <div class="img"><a href="#"><img src="img/news/image3.jpg" alt="new1" class="img-fluid"></a></div>
                        <div class="desc">
                            <h5>The master bedroom suite is phenomeny spacious</h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                            </p>
                        </div>
                    </div>
                    <div class="news_box mt-4">
                        <div class="img"><a href="#"><img src="img/news/image4.jpg" alt="new1" class="img-fluid"></a></div>
                        <div class="desc">
                            <h5>The master bedroom suite is phenomeny spacious</h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
