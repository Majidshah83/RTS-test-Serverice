@extends('admin.app')
@section('title', 'Admin|Add Projects')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">
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
              <h3 class="content-header-title mb-0 d-inline-block">Project</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                     <li class="breadcrumb-item"><a href="{{url('/current/jobs')}}">Current Project</a>
                    </li>
                    <li class="breadcrumb-item active">Add New Project
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{url('/current/projects')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <h4 class="form-section" align="center">Add New Project</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                    <form class="form" method="POST" action="{{url('/add/project')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Project Title<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="job_title" type="text" placeholder="Project Title" id="userinput5"  value="{{ old('job_title') }}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput2">Last Date Test Form Submission</label>
                              <div class="controls">
                               <input class="form-control border-primary" name="job_last_date" type="date" placeholder="Last Date Test Form Submission" id="userinput5" value="{{ old('last_date') }}">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput4">Add Post Type<span class="danger">*</span></label>
                              <div class="controls">
                                    <input type="text" class="form-control border-primary remove-tags selectize-locked"  name="job_type" placeholder="Post Type" >
                                    <input type="hidden" class="form-control border-primary"  name="post_type" id="post_type" required="true">
                              </div> 
                            </div>

                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Advertisement Images<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="ad_image" type="file" placeholder="Advertisement Images"  id="userinput5"  required data-validation-required-message="This field is required" value="{{ old('ad_image') }}">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Application or Challen Form(PDF)</label>
                              <div class="controls">
                              <input class="form-control border-primary" name="ad_form" type="file" placeholder="Ad Form" id="userinput5" value="{{ old('ad_form') }}" >
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput3">Select Apply Type<span class="danger">*</span></label>
                              <div class="controls">
                                 <select  class="form-control border-primary" name="apply_type"  id="apply_type"  value="{{ old('apply_type') }}"  required data-validation-required-message="This field is required" >
                                  <option value="">Select Apply Type</option>
                                  <option value="Online">Online</option>
                                  <option value="Offline">Offline</option>
                              </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                      <a href="{{url('/current/jobs')}}">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                      </a>
                      <button type="submit" class="btn btn-success ">
                        <i class="la la-check-square-o"></i> Save
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


<script type="text/javascript">
  $(document).ready(function(){
      var sritems = [];
      $('.remove-tags').selectize({
        plugins: ['remove_button'],
        persist: false,
        create: true,
        render: {
          item: function(data, escape) {
            sritems.push(data.text);
            $('#post_type').val(sritems);
            return '<div >"' + escape(data.text) + '"</div>';
          }
        },
        onDelete: function(values) {
          return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
        }
      });

  });
</script>


@endsection()