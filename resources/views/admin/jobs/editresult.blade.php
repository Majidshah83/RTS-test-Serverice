@extends('admin.app')
@section('title', 'Admin|Edit Result')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">
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
              <h3 class="content-header-title mb-0 d-inline-block">Result</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                     <li class="breadcrumb-item"><a href="{{url('/result')}}">All Result</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Result
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{url('/result')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <h4 class="form-section" align="center">Edit Result</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                   <div class="card-text">
                    <form class="form" method="POST" action="{{url('/update/result')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$editResult->id}}">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 m-auto">
                            <div class="form-group">
                              <label for="userinput1">Update Result <span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="result" type="file" placeholder="Upload Result" id="result"  value="{{ old('result') }}" accept="application/pdf,application/vnd.ms-excel">
                              <input class="form-control border-primary" name="old_result" type="hidden" placeholder="Upload Result" id="old_result"  value="{{$editResult->result}}">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                      <a href="{{url('/result')}}">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                      </a>
                      <button type="submit" class="btn btn-success ">
                        <i class="la la-check-square-o"></i>Save Changes
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

<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>

<script src="{{asset('public/adminassets/app-assets/js/scripts/forms/select/form-selectize.js')}}" type="text/javascript"></script>


@endsection()