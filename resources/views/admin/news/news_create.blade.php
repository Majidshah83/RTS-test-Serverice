@extends('admin.app')
@section('title', 'Admin|News Create')
@section('stylesheets')

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/editors/tinymce/tinymce.min.css')}}">

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
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
              <h3 class="content-header-title mb-0 d-inline-block">News</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{url('/news')}}">All News</a>
                    </li>
                    <li class="breadcrumb-item active">News
                    </li>
                  </ol>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{url('news')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <h4 class="form-section" align="center">News Create</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                    <form class="form" method="POST" action="{{url('/news/store')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}" >
                                <label for="userinput1">Select Project<span class="danger">*</span></label>
                                <div class="controls" >
                                  <select  class="form-control border-primary" name="project_id"  id="project_id" >
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                       <option value="{{$project->ad_id}}">{{$project->ad_title}}</option>
                                    @endforeach()
                                  </select>
                                  <span class="text-danger">{{ $errors->first('project_id') }}</span>
                                </div>
                              </div>
                            </div>
  
                        <div class="col-md-4" id="annoucement_type" >
                            <div class="form-group {{$errors->has('annoucement_type') ? 'has-error' : ''}}" >
                              <label for="userinput2">Annoucement Type</label>
                              <div class="controls">
                              <select  name="annoucement_type" class="form-control"  >
                                  <option value="">Select Annoucement Type</option>
                                  <option value="news">News</option>
                                  <option value="status">Status</option>
                                  <option value="roll_slip">Roll Slip</option>
                                  <option value="result">Result</option>
                                  <option value="project">Project</option>
                              </select>
                              <span class="text-danger">{{ $errors->first('annoucement_type') }}</span>
                              </div>
                            </div>
                        </div> 

                       </div>
 
                        <div class="row">
                            <div class="col-md-12 m-auto">
                              <div class="form-group {{$errors->has('news') ? 'has-error' : ''}}">
                                <label for="userinput1">News<span class="danger">*</span></label>
                                <div class="controls form-control">
                                <textarea class="tinymce" rows="5" name="news" required data-validation-required-message="This field is required" value={{old('news')}}>
                                </textarea>
                                <span class="text-danger">{{ $errors->first('news') }}</span>
                                </div>
                              </div>
                            </div>
                        </div> 
                
                      </div>
                      <div class="form-actions right">
                        <a href="{{url('news')}}">
                          <button type="button" class="btn btn-warning mr-1">
                            <i class="ft-x"></i> Cancel
                          </button>
                        </a>
                      <button type="submit" class="btn btn-success ">Add News
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
  <script src="{{asset('adminassets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
      type="text/javascript"></script>
  <script src="{{asset('adminassets/app-assets/js/scripts/forms/validation/form-validation.js')}}"
    type="text/javascript"></script>
  <script src="{{asset('adminassets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('adminassets/app-assets/js/scripts/forms/select/form-selectize.js')}}" type="text/javascript"></script>
  <script src="{{asset('adminassets/app-assets/vendors/js/editors/tinymce/tinymce.js')}}" type="text/javascript"></script>
  <script src="{{asset('adminassets/app-assets/js/scripts/editors/editor-tinymce.js')}}" type="text/javascript"></script>

@endsection()