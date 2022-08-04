<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from appletonvillagepharmacy.co.uk/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Jul 2022 05:43:39 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Main Page Contents -->
    <meta content="Real Testing Services" name="keywords" />
    <meta content="Real Testing Services" name="description" />
    <title> Real Testing Services </title>
    <meta name="csrf-token" content="dQQgxXou9VFHP7JBLquU7rm3jlDgQ1D5XaKGTKkM" />
    <!-- Header Contents -->
    <!-- Favicons -->
    <!-- Favicons -->
    <link href="../media.pharmafocuslogin.co.uk/storage/media/appletonvillagepharmacy/siteimages/favicon-appleton-village-pharmacy-23.png" rel="icon">
    <link href="not_found.html" rel="apple-touch-icon">

    @include('frontend.include.style')
    @yield('style')

</head>

<body>
<!-- Top Nav Contents -->
@include('frontend.include.topbar')
<!-- Header Contents -->
@include('frontend.include.navbar')
<!-- Main Page Contents -->
@yield('content')
<!-- Footer Contents -->
<!-- Include common slice for Splash to be accessed on every page -->
<!-- Splash Is Not Set Yet -->
@include('frontend.include.footer')
{{-- <div class="cookie-message" id="cookie_info">
    <div class="pull-left btn-block cookie_info_bar">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-5">
                <p> This website uses cookies to ensure you get the best experience on our website. <a href="page/cookie-policy.html"> More info</a> </p>
            </div>
            <div class="col-md-1">
                <form action="https://appletonvillagepharmacy.co.uk/accept-cookie" method="post" id="accept-cookies">
                    <input type="hidden" name="_token" value="dQQgxXou9VFHP7JBLquU7rm3jlDgQ1D5XaKGTKkM">
                    <button type="submit" class="btn btn-success" style="cursor: pointer;">Okay</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}
<!-- Footer Contents -->
<!-- Bootstrap core JavaScript -->
@include('frontend.include.script')
@yield('script')
<!-- Common Custom Scripts -->
</body>
<!-- Mirrored from appletonvillagepharmacy.co.uk/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Jul 2022 05:43:58 GMT -->

</html>
