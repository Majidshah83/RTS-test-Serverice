<header>
    <!-- logo container hidden-md-down-->
    <div class="logo-row ">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-3">
                    <!-- logo -->
                    <div class="logo">
                        <a href="#"> <img src="{{asset('assets/images/logo.png')}}" class="img-fluid mb-2 mt-2" alt=""> </a>
                    </div>
                </div>
                <div class="col-sm-9 col-md-7 col-lg-9 hidden-sm-down top6">
                    <div class="top-right in6">
                        <ul>
                            <li>
                                <div class="media-left">
                                    <div class="icon"> <i class="fa fa-map-marker"></i></div>
                                </div>
                                <div class="media-right">
                                    <h6 class="font-raleway">Our Location </h6> <span> Rts Office No 2, First Floor, Shakeel Arcade, Sector G13/1, Islamabad </span> </div>
                            </li>
                            <li>
                                <div class="media-left">
                                    <div class="icon"> <i class="fa fa-phone"></i></div>
                                </div>
                                <div class="media-right">
                                    <h6 class="font-raleway">Phone</h6> <span>
                                            <a href="tel:03237819882">
                                                03237819882
                                            </a>
                                        </span> </div>
                            </li>
                            <li>
                                <div class="media-left">
                                    <div class="icon"> <i class="fa fa-fax"></i></div>
                                </div>
                                <div class="media-right">
                                    <h6 class="font-raleway">Fax</h6> <span>
                                            <a href="tel:03237819882">
                                                03237819882
                                            </a>
                                        </span> </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu -->
    <div id="undefined-sticky-wrapper" class="sticky-wrapper" style="height: 58px;">
        <nav class="navbar navbar-toggleable-md navbar-light bg-default">
            <div class="container ">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link" href="{{url('/')}}"> Home</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('all-project')}}"> All Projects</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('/download/rollslip')}}"> Roll Number Slips</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('results')}}"> Results</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('applications-lists')}}"> Eligible/ Ineligible Status</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('answer-key')}}"> Answer keys</a> </li>
{{--                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="javascript:;" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Branches</a>--}}
{{--                            <div class="dropdown-menu" aria-labelledby="dropdown04"> <a class="dropdown-item" href="index.html" class="dropdown-item"> Appleton Village Pharmacy</a> <a class="dropdown-item" href="https://churchstreetchemist.co.uk/" class="dropdown-item"> Church Street Chemist</a> <a class="dropdown-item" href="https://bridgeroadchemist.co.uk/" class="dropdown-item"> Bridge Road Chemist</a> <a class="dropdown-item" href="https://ladybarnlanechemist.co.uk/" class="dropdown-item"> Ladybarn Lane Chemist</a> <a class="dropdown-item" href="https://kirkbytownchemist.co.uk/" class="dropdown-item"> Kirkby Town Chemist</a> <a class="dropdown-item" href="https://sorrellbankchemist.co.uk/" class="dropdown-item"> Sorrell Bank Chemist</a> <a class="dropdown-item" href="https://stanneylanechemist.co.uk/" class="dropdown-item"> Stanney Lane Chemist</a> <a class="dropdown-item" href="https://thattoheathpharmacy.co.uk/" class="dropdown-item"> Heath Pharmacy</a> <a class="dropdown-item" href="https://golbornechemist.co.uk/" class="dropdown-item"> Golborne Late Night Chemist</a> </div>--}}
{{--                        </li>--}}
                        <li class="nav-item"> <a class="nav-link" href="{{route('about-us')}}"> About Us</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('contact-us')}}"> Contact Us</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
