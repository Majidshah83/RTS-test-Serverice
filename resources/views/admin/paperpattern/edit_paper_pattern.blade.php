@extends('admin.app')
@section('title', 'Admin|edit paper pattern')
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
              <h3 class="content-header-title mb-0 d-inline-block">Admin</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                     <li class="breadcrumb-item"><a href="{{url('/paper/pattern')}}"> All paper pattern</a>
                    </li>
                    <li class="breadcrumb-item active">Edit paper pattern
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{url('/paper/pattern')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <h4 class="form-section" align="center">Edit Paper Pattern</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                    <form class="form" method="POST" action="{{url('/update/paper/pattern')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput61">Select Project<span class="danger">*</span></label>
                              <div class="controls">
                              <select id="projectinput61"  name="job_id" class="form-control"  required>
                                <option value="">Select Project</option>
                                <option selected="true" value="{{ $editPaperPattern->job_id }}">{{$editPaperPattern->project->ad_title}}</option>
                                @foreach($allProjects as $project)
                                @if($editPaperPattern->job_id != $project->ad_id)
                                  <option value="{{$project->ad_id}}">{{$project->ad_title}}</option>
                                @endif
                                @endforeach()
                              </select>
                              </div> 
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput60">Show Online<span class="danger">*</span></label>
                              <div class="controls">
                              <select id="projectinput60" name="status" class="form-control"  required>

                                  <option value="">Show Online</option>
                                  <option value="yes" @if($editPaperPattern->status == 'yes') selected @endif>Yes</option>
                                  <option value="no" @if($editPaperPattern->status == 'no') selected @endif>No</option>
                              </select>
                              </div> 
                            </div>
                          </div>
                          
                      
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput500">Upload Paper Pattern<span class="danger">*</span></label>
                              <div class="controls">

                              <input class="form-control border-primary" type="file" id="userinput500"  name="paper_pattern" required>

                              <input class="form-control border-primary" value="{{$editPaperPattern->file}}"  name="old_paper_pattern" type="hidden" >
                              </div>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="id" value="{{$editPaperPattern->id}}">
                      
                      </div>
                      <div class="form-actions right">
                      <a href="{{url('/paper/pattern')}}">
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
<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
    type="text/javascript"></script>
<script src="{{asset('public/adminassets/app-assets/js/scripts/forms/validation/form-validation.js')}}"
  type="text/javascript"></script>
@endsection()