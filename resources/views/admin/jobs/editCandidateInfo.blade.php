@extends('admin.app')

@section('title', 'Admin|Edit Candidate Info')

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
        @if(Auth::user()->role=="Superadmin")

          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">

              <h3 class="content-header-title mb-0 d-inline-block">Project</h3>

              <div class="row breadcrumbs-top d-inline-block">

                <div class="breadcrumb-wrapper col-12">

                  <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Dashboard</a>

                    </li>

                    <li class="breadcrumb-item"><a href="{{url('/current/jobs')}}">Current Project</a>

                    </li>

                    <li class="breadcrumb-item"><a href="{{url('/post/apply/candidate/'.$candidateInfo->job_id)}}">All Candidates</a>

                    </li>

                    <li class="breadcrumb-item active">Add New Cadidate

                    </li>

                  </ol>

                </div>

              </div>

          </div>

          @endif

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header">

                  <a href="{{url('/post/apply/candidate/'.$candidateInfo->job_id)}}">

                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>

                  </a>

                  <h4 class="form-section" align="center">Edit Candidate Info</h4>

                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>

                <div class="card-content collapse show">

                  <div class="card-body">

                    <div class="card-text">

                    <form class="form" method="POST" action="{{url('/update/candidate/info')}}" enctype="multipart/form-data" novalidate>

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <input type="hidden" name="job_id" value="{{$candidateInfo->job_id}}">

                      <input type="hidden" name="candidate_id" value="{{$candidateInfo->candidate_id}}">

                      <h4 class="form-section"><i class="icon-eye"></i>Other Info</h4>

                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Select Test City</label>

                              <div class="controls">

                              <select id="select_city" value="{{ old('select_city') }}"  name="select_city" class="form-control"  >

                                  @foreach($allCity as $allCities)

                                    <option value="{{$allCities->city_id}}" @if($candidateInfo->test_city_id==$allCities->city_id) selected="true" @endif>{{$allCities->city_name}}</option>                                 

                                  @endforeach()

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Applied For Desired Post</label>

                              <div class="controls">

                              <select id="apply_post"   name="apply_post" class="form-control" required data-validation-required-message="This field is required" >

                                @foreach($jobType as $jobtyps)

                                  <option value="{{$jobtyps->job_type_id}}" @if($candidateInfo->post_id==$jobtyps->job_type_id) selected="true" @endif>{{$jobtyps->type_name}}</option>

                                @endforeach()

                              </select>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    <h4 class="form-section"><i class="la la-bank"></i>Bank Challan</h4>

                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Select Bank</label>

                              <div class="controls">

                              <select id="bank" value="{{ old('bank') }}"  name="bank" class="form-control" >

                                  <option value="HBL" @if($candidateInfo->bank_name=="HBL")  @endif>HBL</option>

                                  <option value="UBL" @if($candidateInfo->bank_name=="UBL")  @endif>UBL</option>

                                  <option value="ABL" @if($candidateInfo->bank_name=="ABL")  @endif>ABL</option>

                               </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Bank & brach code</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="branch_code" type="text" placeholder="Branch Code" id="branch_code"  value="{{ $candidateInfo->bank_code }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Deposit Date</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="deposit_date" type="date" placeholder="Deposit Date" id="deposit_date"  value="{{ $candidateInfo->deposit_date }}">

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>

                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Name</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="name" type="text" placeholder="Name" id="name"  value="{{ $candidateInfo->full_name }}" required data-validation-required-message="This field is required">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput2">Father Name</label>

                              <div class="controls">

                               <input class="form-control border-primary" name="father_name" type="text" placeholder="Father Name" id="father_name" value="{{ $candidateInfo->father_name }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">CNIC</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="cnic" type="text" placeholder="CNIC" id="cnic"  value="{{ $candidateInfo->nic }}" required data-validation-required-message="This field is required">

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput2">Gender</label>

                              <div class="controls">

                              <select id="gender" value="{{ old('gender') }}"  name="gender" class="form-control"  >

                                  <option value="Male" @if($candidateInfo->gender=="Male") selected="true" @endif>Male</option>

                                  <option value="Female"@if($candidateInfo->gender=="Female") selected="true" @endif>female</option>

                              </select>

                              </div>

                            </div>

                          </div>

                        <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Date Birth</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="date_birth" type="date" placeholder="Date Of Birth" id="date_birth"  value="{{ $candidateInfo->date_of_birth }}">

                              </div>

                            </div>

                          </div>

                        <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput2">Marital Status</label>

                              <div class="controls">

                              <select id="marital_status"  name="marital_status" class="form-control"  >

                                  <option value="Married" @if($candidateInfo->marital_status=="Married") selected="true" @endif>Married</option>

                                  <option value="Unmarried" @if($candidateInfo->marital_status=="Unmarried") selected="true" @endif>Unmarried</option>

                              </select>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Are You Government Servant?</label>

                              <div class="controls">

                              <select id="g_servent" value="{{ old('g_servent') }}"  name="g_servent" class="form-control">

                              @if($candidateInfo->g_servent=="No")

                                  <option value="No">No</option>

                                  <option value="Yes">Yes</option>

                              @else

                                  <option value="Yes">Yes</option>

                                  <option value="No">No</option>

                              @endif

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">2. Are You a Disabled person?</label>

                              <div class="controls">

                              <select id="d_person" value="{{ old('d_person') }}"  name="d_person" class="form-control">

                                @if($candidateInfo->disabled=="No")

                                    <option value="No">No</option>

                                    <option value="Yes">Yes</option>

                                @else

                                    <option value="No">Yes</option>

                                    <option value="Yes">No</option>

                                @endif

                              </select>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput1">Religion</label>

                            <div class="controls">

                              <select  class="form-control border-primary" name="religion"  placeholder="religion" id="religion"  value="{{ old('religion') }}" >

                               <option value="muslim" @if($candidateInfo->marital_status=="muslim") selected="true" @endif>Muslim</option>

                               <option value="nonmuslim" @if($candidateInfo->marital_status=="nonmuslim") selected="true" @endif>Non Muslim</option>

                              </select>

                            </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Permanent Address</label>

                              <div class="controls">

                              <textarea class="form-control border-primary" name="permanent_address"  placeholder="Permanent Address" id="permanent_address" >{{ $candidateInfo->postal_address }}</textarea>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                                <label for="userinput2">Mailing Address</label>

                                <div class="controls">

                                <textarea class="form-control border-primary" name="mailing_address"  placeholder="Mailing Address" id="mailing_address">{{ $candidateInfo->mailing_address }}</textarea>

                                </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput1">Phone No(optional)</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="phone_no" type="text" placeholder="Phone No" id="phone_no"  value="{{$candidateInfo->phone_no }}" >

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                                <label for="userinput2">Residential</label>

                                <div class="controls">

                                <input class="form-control border-primary" name="residential" type="text" placeholder="Residential" id="residential"  value="{{$candidateInfo->residential }}" >

                                </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Mobile No</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="mobile_no" type="text" placeholder="Mobile No" id="mobile_no"  value="{{$candidateInfo->mobile_no }}" required data-validation-required-message="This field is required">

                              </div>

                            </div>

                          </div>

                           <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">District Local Domicile</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="domicile" type="text" placeholder="Domicile No" id="domicile"  value="{{$candidateInfo->domicile }}" >

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                           <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput1">Select Province</label>

                              <div class="controls">

                               <select  class="form-control border-primary" name="province"  placeholder="province" id="province"  value="{{ old('province') }}" required data-validation-required-message="This field is required">

                              @foreach($allProvince as $allProvinces)

                              <option value="{{$allProvinces->pro_id}}" @if($candidateInfo->post_id==$allProvinces->province) selected="true" @endif>{{$allProvinces->pro_name}}</option>

                              @endforeach()

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                                <label for="userinput2">Picture</label>

                                <div class="controls">

                                <input class="form-control border-primary" name="picture" type="file" placeholder="Picture" id="picture">

                                <input class="form-control border-primary" name="old_picture" type="hidden" placeholder="Picture" value="{{$candidateInfo->upload_image}}" id="picture" >

                              @if($candidateInfo->upload_image!=null)

                                <img width="50px" src="{{asset('/public/public/candidatepicture')}}/{{$candidateInfo->upload_image}}">

                              @endif

                                </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    <h4 class="form-section"><i class="icon-graduation"></i> Academic Information</h4>

                      <div class="form-body">

                         <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput1">Certificate /DegreeLevel</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput1">Degree Name</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Major Subject</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Passing Year</label>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <label for="userinput2">Obtain Marks/CGPA</label>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <label for="userinput2">Total Marks/CGPA</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Institute/Board</label>

                            </div>

                          </div>

                        </div>



               <!--Matric -->

               

                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" type="text" id="matric" name="matric" value="Matric" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                          <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="matric_degree_name" type="text" id="matric_degree_name"  value="{{ $candidateInfo->academic->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_major_subject" type="text"  id="matric_major_subject" value="{{ $candidateInfo->academic->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_passing_year" type="text"  id="matric_passing_year" value="{{ $candidateInfo->academic->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_obtained_marks" type="text"  id="matric_obtained_marks" value="{{ $candidateInfo->academic->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_total_marks" type="text"  id="matric_total_marks" value="{{ $candidateInfo->academic->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_institute" type="text" id="matric_institute" value="{{ $candidateInfo->academic->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>





                  <!--Intermedaite -->





                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary"  type="text" id="intermediate" name="intermediate"  value="Intermediate" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="intermediate_degree_name" type="text" id="intermediate_degree_name"  value="{{ $candidateInfo->intermediate->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_major_subject" type="text" id="intermediate_major_subject" value="{{ $candidateInfo->intermediate->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_passing_year" type="text"

                               id="intermediate_passing_year" value="{{ $candidateInfo->intermediate->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_marks" type="text"  id="intermediate_marks" value="{{ $candidateInfo->intermediate->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_total_marks" type="text"  id="intermediate_total_marks" value="{{ $candidateInfo->intermediate->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_institute" type="text"  id="intermediate_institute" value="{{ $candidateInfo->intermediate->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary"  type="text" id="bachelors" name="bachelors"  value="Bachelors" readonly="true">

                              </div>

                            </div>

                          </div>



                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="bachelors_degree_name" type="text" id="bachelors_degree_name"  value="{{ $candidateInfo->bachelor->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>



                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_major_subject" type="text" id="bachelors_major_subject" value="{{ $candidateInfo->bachelor->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>



                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_passing_year" type="text"

                               id="bachelors_passing_year" value="{{ $candidateInfo->bachelor->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_marks" type="text"  id="bachelors_marks" value="{{ $candidateInfo->bachelor->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_total_marks" type="text"  id="bachelors_total_marks" value="{{ $candidateInfo->bachelor->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_institute" type="text"  id="bachelors_institute" value="{{ $candidateInfo->bachelor->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary"  type="text" id="masters" name="masters"  value="Masters" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="masters_degree_name" type="text" id="masters_degree_name"  value="{{ $candidateInfo->master->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_major_subject" type="text" id="masters_major_subject" value="{{ $candidateInfo->master->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_passing_year" type="text"

                               id="masters_passing_year" value="{{ $candidateInfo->master->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_marks" type="text"  id="masters_marks" value="{{ $candidateInfo->master->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_total_marks" type="text"  id="masters_total_marks" value="{{ $candidateInfo->master->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_institute" type="text"  id="masters_institute" value="{{ $candidateInfo->master->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary qulification"   id="professional1" name="professional1"  value="Prof Qualification" readonly="true" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="professional1_degree_name" type="text" id="professional1_degree_name"  value="{{ $candidateInfo->professional1->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_major_subject" type="text" id="masters_major_subject" value="{{ $candidateInfo->professional1->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_passing_year" type="text"

                               id="professional1_passing_year" value="{{ $candidateInfo->professional1->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_marks" type="text"  id="professional1_marks" value="{{ $candidateInfo->professional1->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_total_marks" type="text"  id="professional1_total_marks" value="{{ $candidateInfo->professional1->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_institute" type="text"  id="professional1_institute" value="{{ $candidateInfo->professional1->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row proffissional">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary"  type="hidden" id="professional2" name="professional2"  value="professional_qualification1" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="professional2_degree_name" type="text" id="professional2_degree_name"  value="{{ $candidateInfo->professional1->degree_sanad_title }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_major_subject" type="text" id="professional2_major_subject" value="{{ $candidateInfo->professional1->specialization_major_subject }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_passing_year" type="text"

                               id="professional2_passing_year" value="{{ $candidateInfo->professional1->year_passing }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_marks" type="text"  id="professional2_marks" value="{{ $candidateInfo->professional1->obtained_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_total_marks" type="text"  id="professional2_total_marks" value="{{ $candidateInfo->professional1->total_marks_cgpa }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_institute" type="text"  id="professional2_institute" value="{{ $candidateInfo->professional1->board_university }}">

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    <h4 class="form-section"> <i class="icon-folder-alt"></i>Employment Record</h4>

                      <div class="form-body">

                         <div class="row">

                          <div class="col-md-1">

                            <div class="form-group">

                              <label for="userinput1">S.no</label>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput1">Organization / Employer Name</label>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput2">Job Title</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Job Duration(From)</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Job Duration(To)</label>

                            </div>

                          </div>

                        </div>





                        <div class="row">

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="no" value="1" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="employer_name" type="text" id="employer_name" value="{{$candidateInfo->employmentRecord->organization_employer_name1}}" >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title" type="text" id="job_title" value="{{$candidateInfo->employmentRecord->job_title1}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from" type="date"  id="job_from" value="{{$candidateInfo->employmentRecord->duration_from1}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to" type="date"  id="job_to" value="{{$candidateInfo->employmentRecord->duration_to1}}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row">

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="no2" value="2" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="employer_name2" type="text" id="employer_name2" value="{{$candidateInfo->employmentRecord->organization_employer_name2}}" >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title2" type="text" id="job_title2" value="{{$candidateInfo->employmentRecord->job_title2}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from2" type="date"  id="job_from2" value="{{$candidateInfo->employmentRecord->job_from2}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to2" type="date" id="job_to2" value="{{$candidateInfo->employmentRecord->duration_to3}}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row">

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="no3" value="3" readonly="true" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="employer_name3" type="text" id="employer_name3" value="{{$candidateInfo->employmentRecord->organization_employer_name3}}" >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title3" type="text" id="job_title3" value="{{$candidateInfo->employmentRecord->job_title3}}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from3" type="date"  id="job_from3" value="{{$candidateInfo->employmentRecord->duration_from3}}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to3" type="date"  id="job_to3" value="{{$candidateInfo->employmentRecord->duration_to3}}">

                              </div>

                            </div>

                          </div>

                        </div>



                      <div class="row">

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput1" style="margin-top: 34px;">Total Years Experience:</label>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Days</label>

                              <div class="controls">

                               <input class="form-control border-primary" name="days" type="text" placeholder="Days" id="days" value="{{$candidateInfo->totalExpirence->days}}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Months</label>

                              <div class="controls">

                               <input class="form-control border-primary" placeholder="Months" name="months" type="text" id="months" value="{{$candidateInfo->totalExpirence->month}}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Years</label>

                              <div class="controls">

                               <input class="form-control border-primary" name="years" type="text" placeholder="Years" id="years" value="{{$candidateInfo->totalExpirence->years}}">

                              </div>

                            </div>

                          </div>

                        </div>

                      <h4 class="form-section"><i class="icon-eye"></i>Checking Document</h4>

                      <div class="form-group">

                          <div class="c-inputs-stacked">

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="photo" class="custom-control-input" id="photo" @if($candidateInfo->photo=="on")

                              checked="true" 

                              @endif>

                              <label class="custom-control-label" for="photo">Two Photographs</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="educational_certificates" class="custom-control-input" id="educational_certificates" @if($candidateInfo->educational_certificates=="on")

                              checked="true" 

                              @endif>

                              <label class="custom-control-label" for="educational_certificates">educational certificates</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="domicile_cnic" class="custom-control-input" id="domicile_cnic" @if($candidateInfo->domicile_cnic=="on")

                              checked="true" 

                              @endif>

                              <label class="custom-control-label" for="domicile_cnic">Domicile/CNIC copy</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="bank_slip" class="custom-control-input" id="bank_slip"  @if($candidateInfo-> bank_slip=="on")

                              checked="true" 

                              @endif>

                              <label class="custom-control-label" for="bank_slip">Original Bank Deposit Slip</label>

                            </div>

                          </div>

                        </div>

                      </div>

                      <h4 class="form-section"><i class="la la-legal"></i>Checking Status</h4>

                      <div class="form-group">

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                                <label for="userinput2">Select Candidate Status</label>

                                <div class="controls">

                                <select  class="form-control border-primary" name="status"  placeholder="status" id="status" value="{{ old('status') }}"  required data-validation-required-message="This field is required" >

                                @if($candidateInfo->status=="pending")

                                <option value="pending" @if($candidateInfo->status=="pending") selected @endif>Pending</option>

                                @endif

                                <option value="Eligible" @if($candidateInfo->status=="Eligible") selected @endif>Eligible</option>

                                <option value="NotEligible" @if($candidateInfo->status=="NotEligible") selected @endif>NotEligible</option>

                                <option value="Rejected" @if($candidateInfo->status=="Rejected") selected @endif>Rejected</option>

                                </select>

                                </div>

                            </div>

                          </div>

                        </div>

                      </div>

                      <div class="form-actions right">

                      <a href="{{url('/post/apply/candidate',$candidateInfo->job_id)}}">

                        <button type="button" class="btn btn-warning mr-1">

                          <i class="ft-x"></i> Cancel

                        </button>

                      </a>

                      <button type="submit" class="btn btn-success" >

                        <i class="la la-check-square-o"></i> Save Changes

                      </button>

                      </div>

                    </form>

                  </div>

                </div>

              </div>

            </div>

          </div>

      </div>

      <section id="basic-modals">

          <div class="row">

            <div class="col-12">

                <div class="card-content collapse show">

                  <div class="card-body">

                    <div class="row my-2">

                      <div class="col-lg-4 col-md-6 col-sm-12">

                        <div class="form-group">

                          <!-- Modal -->

                          <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"

                          aria-hidden="true">

                            <div class="modal-dialog" role="document">

                              <div class="modal-content">

                                 <div class="modal-header bg-danger white">

                                  <h4 class="modal-title white" id="myModalLabel10">Missing Field OR Document</h4>

                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                  </button>

                                </div>

                                  <div class="modal-body">

                                  <div id="missing_field">

                                  </div>

                                  <hr>

                                  <p>Do you want to proceed or reject ?</p>

                                </div>

                                <div class="modal-footer">

                                  <button type="button" class="btn grey btn-outline-danger"  id="reject" data-dismiss="modal">Reject</button>

                                  <button type="button" class="btn btn-outline-success proceed">Proceed</button>

                                </div>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </section>

    </div>

@endsection

@section('scripts')



<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"

    type="text/javascript"></script>



<script src="{{asset('public/adminassets/app-assets/js/scripts/forms/validation/form-validation.js')}}"

  type="text/javascript"></script>



<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>



<script src="{{asset('public/adminassets/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>



<script src="{{asset('public/adminassets/app-assets/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>



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