<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  
  <meta name="author" content="PIXINVENT">
 
  <title>@yield('title')</title>
 
  
  <!-- BEGIN VENDOR CSS-->
  @include('admin.include.style')
  @yield('stylesheets')
  <!-- Ending Css -->
  </head>
  <body class="horizontal-layout horizontal-menu horizontal-menu-padding 2-columns   menu-expanded"
  data-open="click" data-menu="horizontal-menu" data-col="2-columns">
   <!--navbar -->
@include('admin.include.sidebar')

   <!--end sidebar -->
   <!-- ////////////////////////////////////////////////////////////////////////////-->
   <!-- body -->
           
  <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
      </div>
      @if(Session::has('update_password'))
          <div class="alert alert-success">
              <strong>Updated:</strong> {{ Session::get('update_password')}}
          </div>
      @endif
      @yield('content')
    </div>
  </div>

   <!-- endbody -->

   <!-- ////////////////////////////////////////////////////////////////////////////-->

  <!--footer -->

  @include('admin.include.footer')
  <!-- end footer -->

  @include('admin.include.script')
    
  @yield('scripts')

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       <form class="form-horizontal" method="post" action="{{URL('/updated/password')}}" role="form">    
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{Auth::User()->id}}">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">                                      
                  <div class="form-group">
                      <div class="col-md-12">
                         <input type="password" class="form-control" minlength="6" required="true" name="changes_pasword">
                      </div>
                  </div>                                         
              </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Changes Password</button>    
        </div>
       </form>
      </div>
    </div>
  </div>
  <!-- END PAGE LEVEL JS-->
  </body>

</html>