

 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="main-menu-content">

      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


        @if(Auth::user()->role=="Superadmin" || Auth::user()->role=="Admin")

		        <li class=" nav-item"><a href="{{url('/dashboard')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
		        </li>

		        <li class="nav-item"><a href="{{URL('/country/all')}}"><i class="ft-map-pin"></i><span class="menu-title" data-i18n="nav.templates.main">Center & Location </span></a>

		          <ul class="menu-content">

		                <li><a class="menu-item" href="{{URL('/location')}}" data-i18n="nav.templates.horz.classic">All Location</a>

		                </li>

		                <li><a class="menu-item" href="{{URL('/current/center')}}" data-i18n="nav.templates.horz.classic">All Center</a>

		                </li>

		           </ul>

		        </li>

        @endif



        <li class="nav-item"><a href="{{URL('/current/projects')}}"><i class="la la-briefcase"></i><span class="menu-title" data-i18n="nav.templates.main">Projects</span></a>

        </li>

        @if(Auth::user()->role=="Superadmin" || Auth::user()->role=="Admin")
            <li class="nav-item"><a href="{{url('/news')}}"><i class="la la-briefcase"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">News Managment</span></a>
            </li>
        @endif

        @if(Auth::user()->role=="Superadmin" || Auth::user()->role=="Admin")
            <li class="nav-item"><a href="{{url('/result')}}"><i class="la la-briefcase"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Result Managment</span></a>

            </li>
        @endif

        @if(Auth::user()->role != "Operator")
          <li class="nav-item"><a href="{{url('/paper/pattern')}}"><i class="la la-briefcase"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Paper Pattern</span></a>
            </li>
            <li class="nav-item"><a href="{{url('/create/sms')}}"><i class="la la-briefcase"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">Send SMS</span></a>
            </li>
        @endif

        @if(Auth::user()->role=="Superadmin")
          <li class="nav-item"><a href="#"><i class="icon-user-follow"></i><span class="menu-title" data-i18n="nav.templates.main">Admin Management</span></a>
             <ul class="menu-content">
                  <li><a class="menu-item" href="{{URL('/all/admin')}}" data-i18n="nav.templates.horz.classic">All Admin</a>
                  </li>
             </ul>
          </li>
        @endif



      </ul>

    </div>

  </div>
