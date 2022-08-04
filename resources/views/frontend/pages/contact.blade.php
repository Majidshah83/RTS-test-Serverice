@extends('frontend.master')
@section('title', 'About Us')
@section('content')
    <!-- Main Page Contents -->
    <div class="container-fluid">
        <div class="row align-content-center">
            <div class="page-title">
                <div class="box-overlay">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('index')}}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ol>
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row mt-5">

            <div class="col-12 text-center">
                <h4 class="heading-small"> Appleton Village Pharmacy </h4>
                <h2 class="section-heading">Our Contact Info</h2>
            </div>

        </div>

        <div class="row my-4">

            <div class="col-lg-4 col-md-4 col-sm-12 text-center contact-info">
                <i class="fa fa-map-marker"></i>
                <h5 class="text-uppercase">Visit Appleton Village Pharmacy</h5>
                <p> Appleton Village, Widnes, WA8 6EQ </p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 text-center contact-info">
                <i class="fa fa-phone"></i>
                <h5 class="text-uppercase">Call Us</h5>
                <p> <a href="tel:01514208794"> 01514208794 </a> </p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 text-center contact-info">
                <i class="fa fa-fax"></i>
                <h5 class="text-uppercase">Email</h5>
                <p> <a href="tel:01514959140"> 01514959140 </a> </p>
            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="map mt-5">
                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClNt-uRlml8UOgRrnOndykKfRgVUayAcQ&amp;q=Appleton+Village+Pharmacy%2C+Appleton+Village%2C+Widnes%2C+WA8+6EQ" allowfullscreen="allowfullscreen" width="100%" height="400" frameborder="0" style="border:0"></iframe>
            </div>
        </div>

    </div>
    <div class="container">

        <div class="row mt-5">

            <div class="col-12 text-center">

                <h4 class="heading-small">Feel Free To Contact Us</h4>

                <h2 class="section-heading">Get In Touch</h2>

            </div>

        </div>

        <div class="row mt-2 mb-5">

            <div class="col-lg-6 col-md-8 col-sm-12 d-block mx-auto contact">
                <form method="post" role="form" class="php-email-form" id="contact_us_frm">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" id="error_div" style="display:none;">

                                <ul id="error_ul"></ul>

                            </div>

                            <div class="alert alert-success" id="success_div" style="display:none;">

                                <ul id="success_ul"></ul>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6 col-sm-12">
                            <input type="text"  name="name" class="form-control" id="name" placeholder="Your Name"
                                   kl_vkbd_parsed="true">
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <input type="email" class="form-control" name="email_address" id="email_address"
                                   placeholder="Your Email" kl_vkbd_parsed="true">
                        </div>

                    </div>

                    <div class="form-group ">
                        <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Your Contact Number"
                               kl_vkbd_parsed="true">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                    </div>

                    <div class="my-3">
                        <div class="error-message" style="display: none;"></div>
                        <div class="sent-message" style="display: none;">Your message has been sent. Thank you!</div>
                    </div>

                    <div class="form-group mt-3">

                        <!-- Google Captcha V2 Script -->
                        <script src="../www.google.com/recaptcha/api.js" async defer></script>

                        <!-- Google Captcha V2 Div -->
                        <div class="g-recaptcha" data-sitekey="6LfAOOoaAAAAAGk9tjszOQVJdyEszM3zX_P9PbyS"></div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" id="contact_us_submit_btn" class="btn btn-primary btn-send"> Send Message </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>
@stop
