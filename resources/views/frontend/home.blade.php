@extends('frontend.master')
@section('title', 'Banners Section')
@section('style')
    <style>
        /*****************************
*	vertical news ticker with image
******************************/
        .ticker-wrapper-v-image{
            display: flex;
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        .news-ticker-v-image{
            list-style: none;
            margin:0;
            padding: 0;
            animation: tic-v-image 20s cubic-bezier(1, 0, .5, 0) infinite;
        }

        .news-ticker-v-image:hover {
            animation-play-state: paused;
        }

        .news-ticker-v-image li{
            margin-bottom: 20px;
        }

        @keyframes tic-v-image {
            0%   {margin-top: 0;}
            25%  {margin-top: -16%;}
            50%  {margin-top: -32%;}
            75%  {margin-top: -50%;}
            100% {margin-top: 0;}
        }
    </style>
@stop
@section('content')
<div class="banner">
    <div class="banner-one slick-initialized slick-slider">
        <div aria-live="polite" class="slick-list draggable">
            <div class="slick-track" role="listbox" style="opacity: 1; width: 1519px;">
                <div class="banner-one-layer slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00" style="width: 1519px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                    <img src="{{asset('assets/images/multiple.webp')}}" alt="" class="img-fluid"> <span class="banner-transparent"></span>
                    <div class="banner-caption"> <span class="banner-transparent-shape"></span>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="banner-wrap">
                                        <h3>Welcome to</h3>
                                        <h1>Real Testing <br> Services</h1>
                                        <p>Promoting merit and Transparency </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Slider overlay content-->
<div class="container">
    <div class="row">
        <div class="slider-content-overlay">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="box1">
                    <div class="box-overlay">
                        <div class="box-description">
                            <div class="box-icon"> <i class="fa fa-file-text-o"></i> </div>
                            <div class="box-content">
                                <h3> All Projects </h3>
                                <p> List all latest projects... </p>
                                <a href="{{route('all-project')}}">More Detail <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="box2">
                    <div class="box-overlay">
                        <div class="box-description">
{{--                            <div class="box-icon"> <i class="fa fa-file-text-o"></i> </div>--}}
                            <div class="box-content">
                                <h3> Roll Number Slips </h3>
                                <p> Check or Download your number slips... </p> <a href="{{route('/download/rollslip')}}">More Detail <i class="fa fa-angle-double-right"></i></a> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="box3">
                    <div class="box-overlay">
                        <div class="box-description">
{{--                            <div class="box-icon"> <i class="fa fa-file-text-o"></i> </div>--}}
                            <div class="box-content">
                            <h3> All Results </h3>
                            <p> Browse all results related to projects... </p> <a href="{{route('results')}}">More Detail <i class="fa fa-angle-double-right"></i></a> </div>
                        </div>
                    </div>
                </div>
            </div>

              <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="box4">
                    <div class="box-overlay">
                        <div class="box-description">
{{--                            <div class="box-icon"> <i class="fa fa-file-text-o"></i> </div>--}}
                            <div class="box-content">
                                <h3> Eligible/ Ineligible List </h3>
                                <p> List all eligible and ineligible list... </p> <a href="{{route('applications-lists')}}">More Detail <i class="fa fa-angle-double-right"></i></a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="services-block">
                <div class="services">
{{--                    <div class="services-icon"> <img src="../media.pharmafocuslogin.co.uk/storage/media/appletonvillagepharmacy/services/thumbnail/thumbnail-smoking-cessation-service-224.png" alt="Smoking Cessation Service" class="roundicon"> </div>--}}
                    <div class="services-content">
                        <a href="#">
{{--                            <h3 class="text-center heading-small">Vision</h3>--}}
                            <h2 class="text-center section-heading">Vision</h2>
                        </a>
                        <p>
                            Aspiring to contribute part in nation-building by providing equal opportunities in education and employment; Established with a vision to standardize educational and professional testing in Pakistan
                        </p>
                    </div>
                </div>
                <div class="services">
                    <div class="services-content">
                        <a href="#">
                            <h2 class="text-center section-heading">Mission</h2>
                        </a>
                        <p>
                            We are dedicated to extend premium servicesin public and private sector recruitment with highegt standards of professional values and rules of business to develop a sustainable environment for selection based on merit, transparency and integrity
                        </p>
                    </div>
                </div>
{{--                <div class="services">--}}
{{--                    <div class="services-icon"> <img src="../media.pharmafocuslogin.co.uk/storage/media/appletonvillagepharmacy/services/thumbnail/thumbnail-emergency-hormonal-contraceptives-226.png" alt="Emergency Hormonal Contraceptives" class="roundicon"> </div>--}}
{{--                    <div class="services-content">--}}
{{--                        <a href="#">--}}
{{--                            <h3>Emergency Hormonal Contraceptives</h3> </a>--}}
{{--                        <p> The morning after pill as commonly referred is an emergency hormonal contraceptive pill which can be... </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12">
            <h4 class="heading-small">Welcome to Real Testing Services</h4>
            <h2 class="section-heading ">ABOUT US &amp; WHY CHOOSE US</h2>
            <p class="text-justify">Real Testing Services-RTS has been established to provide quality testing services for
                promoting merit and transparency in admission and recruitment process.
                In today's world where competition has increased manifold,
                the task of testing agencies has also become more challenging.
                While concerns over integrity and transparency is the limelight of
                today's tegting and recruiting process, Real Testing Services is an
                initiative to remedy public by rebuilding trust through quality
                Testing services based on international standards , practices and research -
                based assessments of candidates. </p>
            <p> We have created a sustainable recruitment
                platform focusing on fast, secure and modernized digital system that
                caters to the needs o f candidates ' and recruiting departments.RTS ensures fair
                competition, reliability and result - based outcomes.At RTS we have a
                dedicated management team that oversee day-to-day functioning of the
                organization duly supported by expert consultants, educators and field personnel.
                It is fair to say that we have reimagined testing.<a href="{{route('about-us')}}">...</a>
                <br /> <a class="btn btn-primary mt-4" href="{{url('about-us')}}">Read More</a></p>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 eps">
            <style type="text/css">
                .panel-body2 {
                    max-height: 430px;
                    margin-bottom: 10px;
                    overflow: scroll;
                    -webkit-overflow-scrolling: touch;
                }
            </style>
            <div>
                <h2 class="section-heading">Latest News</h2> </div>
            <div class="panel-body2 ticker-wrapper-v-image">
                <ul class="list-group news-ticker-v-image">

                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Kirkby Town Chemist</strong> </a>
                        <p><a href="#">2 Newtown Gardens, Kirkby, Liverpool, L32 8RR</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Stanney Lane Chemist</strong> </a>
                        <p><a href="#">36 Stanney Lane, Ellesmere Port, Cheshire, CH65 9AD</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Golborne Late Night Chemist</strong> </a>
                        <p><a href="#">98 High Street, Golborne, Warrington, WA3 3DA</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Church Street Chemist</strong> </a>
                        <p><a href="#">99-101 Church Street, Eccles, Manchester, M30 0EJ</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Ladybarn Lane Chemist</strong> </a>
                        <p><a href="#">3 Ladybarn Lane, Manchester, M14 6NQ</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Sorrell Bank Chemist</strong> </a>
                        <p><a href="#">23 Bolton Road, Salford, Manchester, M6 7HL</a></p>
                    </li>
                    <li class="list-group-item"><a href="#"><img width="29px" src="{{asset('assets/images/news.gif')}}"><strong>Heath Pharmacy</strong> </a>
                        <p><a href="#">18-20 Elephant Lane, Thatto Heath, St Helens, WA9 5QW</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@include('frontend.components.quick_help')
@include('frontend.components.our_location')

@stop
