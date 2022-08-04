@extends('admin.app')
@if(Auth::user()->role=="Admin")
@section('title', 'Admin|Edit admin')
@elseif (Auth::user()->role=="Operator")
@section('title', 'Operator|Edit operator')
@endif
@section('stylesheets')

      <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">

@endsection
@section('content')
      <div class="content-body">
         @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>Created:</strong> {{ Session::get('success')}}
            </div>
          @endif
          @if(Session::has('update'))
            <div class="alert alert-success">
                <strong>Updated:</strong> {{ Session::get('update')}}
            </div>
          @endif
          @if(Session::has('delete'))
            <div class="alert alert-danger">
                <strong>Deleted:</strong> {{ Session::get('delete')}}
            </div>
          @endif
          @if(Session::has('error'))
            <div class="alert alert-danger">
                <strong>Failed:</strong> {{ Session::get('error')}}
            </div>
          @endif
          @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif  
        <!-- Revenue, Hit Rate & Deals -->
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
              <h3 class="content-header-title mb-0 d-inline-block">@if(Auth::user()->role=="Operator") Operator @else Admin @endif</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                    @if(Auth::user()->role=="Superadmin")
                    <li class="breadcrumb-item"><a href="{{url('/all/admin')}}"> All admin</a>
                    @endif
                    </li>
                    <li class="breadcrumb-item active">Edit @if(Auth::user()->role=="Operator") Operator @else Admin @endif
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                @if(Auth::user()->role=="Superadmin")
                  <a href="{{url('/all/admin')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                @endif
                  <h4 class="form-section" align="center">Edit @if(Auth::user()->role=="Operator") Operator @else Admin @endif</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                    <form class="form" method="POST" action="{{url('/update/admin')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$editAdmin->id}}">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Fist Name<span class="danger">*</span></label>
                              <div class="controls">
                               <input class="form-control border-primary" name="first_name" type="text" placeholder="First Name" id="userinput5"  value="{{$editAdmin->first_name}}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput2">Last Name<span class="danger">*</span></label>
                              <div class="controls">
                               <input class="form-control border-primary" name="last_name" type="text" placeholder="Last Name" id="userinput5" value="{{$editAdmin->last_name}}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Email<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="email" type="email" placeholder="Email"  id="userinput5" data-validation-required-message="This field is required" value="{{$editAdmin->email}}">
                              <input class="form-control border-primary" name="old_email" type="hidden" placeholder="Email"  id="userinput5"  value="{{$editAdmin->email}}">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput4">Select Role<span class="danger">*</span></label>
                              <div class="controls">
                              <select id="projectinput6" value="{{ old('role') }}"  name="role" class="form-control"  required>
                                  <option value="{{$editAdmin->role}}" selected="{{$editAdmin->role}}">{{$editAdmin->role}}</option>
                                  @if(Auth::user()->role=="Superadmin")
                                    <option value="Admin">Admin</option>
                                  @endif()
                              </select>
                              </div> 
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Image<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="add_image" type="file" placeholder="image" id="userinput5" value=""{{$editAdmin->image}}" accept="image/*">
                              <input class="form-control border-primary" value="{{$editAdmin->image}}"  name="old_image" type="hidden" >
                              <img  class="form-control border-primary" src="{{ asset('public/public/adminimages') }}/{{$editAdmin->image}}" width="20px" height="150px" id="userinput6">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                      <a href="{{url('/all/admin')}}">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                      </a>
                        <button type="submit" class="btn btn-success ">
                          <i class="la la-check-square-o"></i> Save Changes
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--/ Revenue, Hit Rate & Deals -->
      </div>
    </div>
@endsection
@section('scripts')

  <script src="{{asset('public/adminassets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
      type="text/javascript"></script>
  <script src="{{asset('public/adminassets/app-assets/js/scripts/forms/validation/form-validation.js')}}"
    type="text/javascript"></script>

@endsection()