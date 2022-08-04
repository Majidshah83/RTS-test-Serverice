@extends('admin.app')
@section('title', 'Admin|Generate Roll Slip')
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
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
              <h3 class="content-header-title mb-0 d-inline-block">Roll Slip</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{url('/current/projects')}}">Current Porjects</a>
                    </li>
                     <li class="breadcrumb-item"><a href="{{url('/post/apply/candidate/'.$id)}}">All Candidate</a>
                    </li>
                    <li class="breadcrumb-item active">All Apply Candidates
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{url('/post/apply/candidate/'.$id)}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <h4 class="form-section" align="center">Generate Roll Slip</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                    <form class="form" method="POST" action="{{url('/add/roll/slip')}}" enctype="multipart/form-data" novalidate>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id" value="{{$id}}">
                      <div class="form-body">
                        <div class="row">
                         
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="userinput1">Select Desired Post <span class="danger">*</span></label>
                              <div class="controls">
                              <select   name="post_id" id="post_id" class="form-control" required data-validation-required-message="This field is required" rea>
                              <option value="">Select Desired Post</option>
                              @foreach($jobType as $jobTypes)
                                   <option value="{{$jobTypes->job_type_id}}">{{$jobTypes->type_name}}</option>
                              @endforeach()
                              </select>
                              </div>
                            </div>
                          </div>    
                            
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="userinput2">Select Test City<span class="danger">*</span></label>
                              <div class="controls">
                              <select id="test_city" name="city" class="form-control"  required data-validation-required-message="This field is required">
                                <option value="">Select Test City</option>
                                @foreach($allCities as $allCity)
                                  <option value="{{$allCity->city_id}}">{{$allCity->city_name}}</option>
                                @endforeach() 
                              </select>
                              </div>
                            </div>
                          </div>
                      
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="userinput1">Selecte Center<span class="danger">*</span></label>
                              <div class="controls">
                              <select id="center"  name="center" id="center" class="form-control" required data-validation-required-message="This field is required" rea>
                              <option value="">Select Test Center</option>
                              </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Total Candidate Space<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="total_space" type="text" placeholder="Total Candidate Space" id="total_space" readonly="true" value="{{ old('total_space') }}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Total Availabel Candidate<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="total_availabel_candidate" type="text" placeholder="Total Availabel Candidate" id="total_availabel_candidate" readonly="true">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Selecte Date<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="date" type="date" placeholder="Center Name" id="userinput5"  value="{{ old('date') }}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Selecte Time<span class="danger">*</span></label>
                              <div class="controls">
                              <input class="form-control border-primary" name="time" type="time" placeholder="Test Time" id="time"  value="{{ old('time') }}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                        </div>
                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Start RollSlip<span class="danger">*</span></label>
                              <div class="controls">
                                <input class="form-control border-primary" name="st_roll" type="text" placeholder="Start Roll Slip" id="st_roll"  value="{{ old('end_roll') }}" required data-validation-required-message="This field is required">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions right">
                      <a href="{{url('/current/center')}}">
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

<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>

<script src="{{asset('public/adminassets/app-assets/js/scripts/forms/select/form-selectize.js')}}" type="text/javascript"></script>


  <script type="text/javascript">
       
        $(document).ready(function(){
            $('#test_city').click(function(){
                var $option = $(this).find('option:selected');
                var value = $option.val();  
                $.ajax({
                      type:"get",
                      url:"{{ url('/select/center') }}",
                      data:{city:value},
                      success: function(response){
                          $('#center').html(response);
                }
            });
          });
        });

  </script>

  <script type="text/javascript">

         $(document).ready(function(){
            $('#center').click(function(){
                  var $option = $(this).find('option:selected');
                  var value = $option.val();  
                  $.ajax({
                      type:"get",
                      url:"{{ url('/select/center/space') }}",
                      data:{center:value},
                      success: function(response){
                          $('#total_space').val(response);
                  }
                 });
            });
          });

  </script>

  <script type="text/javascript">

       $(document).ready(function(){
          $('#test_city').click(function(){
                var $option = $(this).find('option:selected');
                var value = $option.val();  
                $.ajax({
                    type:"get",
                    url:"{{ url('/available/candidate') }}",
                    data:{city:value},
                    success: function(response){
                        $('#total_availabel_candidate').val(response);
                }
               });
          });
       });

  </script>


@endsection()