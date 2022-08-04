@extends('admin.app')
 @section('title', 'Admin|All Candidate')
 
 @section('stylesheets')
  
  <link rel="stylesheet" type="text/css" href="{{asset('public/adminassets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('public/adminassets/app-assets/fonts/feather/style.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('public/adminassets/app-assets/fonts/simple-line-icons/style.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('public/adminassets/app-assets/vendors/css/extensions/sweetalert.css')}}">

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
            <div class="alert alert-success">
                <strong>Deleted:</strong> {{ Session::get('delete')}}
            </div>
          @endif
          @if(Session::has('superadmin'))
            <div class="alert alert-danger">
                <strong></strong> {{ Session::get('superadmin')}}
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
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>
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
              <div class="col-12">
                <div class="card">
                <div class="card-header">
                  <h4 class="form-section" align="center">Test City Space</h4>
                  <br>
                  <br>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              
                  <a href="{{url('/post/apply/candidate/'.$id)}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  
                  <a href="{{url('/add/roll/slip/'.$id)}}">
                    <button type="button" class="btn btn-warning btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-plus"></i>Generate Roll Slip</button>
                  </a>
                  
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th width="5%">S.no</th>
                          <th width="15%">Test City</th>
                          <th width="20%">Total Space Candidate All Center</th>
                          <th width="20%">Total Candidate Available</th>
                        </tr>
                        </thead>
                       <tbody>
                       @foreach($allCitySpace as $key=>$allCitySpaces)
                          <tr  @if($allCitySpaces->candidate_id <= App\Http\Controllers\admin\JobController::totalSpaceCenter($allCitySpaces->test_city_id)) class="bg-success white" @else class="bg-danger white" @endif>
                            <td>{{++$key}}</td>
                            <td>{{$allCitySpaces->testCity->city_name}}</td>
                            <td>{{App\Http\Controllers\admin\JobController::totalSpaceCenter($allCitySpaces->test_city_id)}}</td>
                            <td>{{$allCitySpaces->candidate_id}}</td>
                          </tr>
                        @endforeach()
                       </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--/ Revenue, Hit Rate & Deals -->
      </div>

  @endsection
  @section('scripts')

  <script src="{{asset('public/adminassets/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
 

  <script src="{{asset('public/adminassets/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"
  type="text/javascript"></script>

  <script src="{{asset('public/adminassets/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('public/adminassets/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>

  <script type="text/javascript">
          $(document).ready(function() {
                $('body').tooltip({
                  selector: "[data-tooltip=tooltip]",
                  container: "body"
                });
          });
  </script> 



  @endsection()