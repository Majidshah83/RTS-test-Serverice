 <!-- fixed-top-->

  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">

    <div class="navbar-wrapper">

      <div class="navbar-header">

        <ul class="nav navbar-nav flex-row">

          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>

          <li class="nav-item mr-auto">

            <a class="navbar-brand">

             {{--  <img class="brand-logo" alt="modern admin logo" src="{{asset('public/adminassets/app-assets/images/logo/logo.png')}}"> --}}

              <h3 class="brand-text">
                  Realts Panel 
              </h3>

            </a>

          </li>

          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>

          <li class="nav-item d-md-none">

            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>

          </li>

        </ul>

      </div>

      <div class="navbar-container content">

        <div class="collapse navbar-collapse" id="navbar-mobile">

          <ul class="nav navbar-nav mr-auto float-left">

            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>

          </ul>

               <ul class="nav navbar-nav float-right">

              <li class="dropdown dropdown-user nav-item">

                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">

                <span class="mr-1">

                    <span class="user-name text-bold-700">{{Auth::user()->full_name}}</span>

                  </span>

                  @if(empty(Auth::user()->image))

            

                  <span class="avatar avatar-online">

                    <img  src="{{ asset('public/public/adminimages/dummy.jpg') }}"  alt="avatar"><i></i></span>

             

                  @elseif(Auth::user()->role=="candidate")

 

                  <span class="avatar avatar-online">

                    <img  src="{{ asset('public/public/candidatepicture') }}/{{Auth::user()->image}}"  alt="avatar"><i></i></span>





                  @else

                 

                   <span class="avatar avatar-online">

                    <img  src="{{ asset('public/public/adminimages') }}/{{Auth::user()->image}}"  alt="avatar"><i></i></span>



                @endif

                </a>    

                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" @if(Auth::user()->role!="candidate") href="

                   {{url('/edit/admin',Auth::user()->id)}}"  @else href="

                   {{url('/edit/profile',Auth::user()->id)}}"   @endif><i class="ft-user"></i> Edit Profile </a>

                  <a href="#"  class="dropdown-item"  data-toggle="modal" data-target="#exampleModal"><i class="ft-user"></i>Change Password</a>

                  <div class="dropdown-divider"></div><a class="dropdown-item" href="{{url('/logout')}}"><i class="ft-power"></i> Logout</a>

                </div>

              </li>

            </ul>

        </div>

      </div>

    </div>

  </nav>