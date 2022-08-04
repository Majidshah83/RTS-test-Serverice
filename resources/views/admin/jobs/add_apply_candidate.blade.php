@extends('admin.app')

@section('title', 'Admin|Add Apply Candidate')

@section('stylesheets')

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">
   <style>
#myOnlineCamera video{width:320px;height:240px;margin:15px;float:left;}
#myOnlineCamera canvas{width:320px;height:240px;margin:15px;float:left;}
#myOnlineCamera button{clear:both;margin:30px;}
</style>

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

                    <li class="breadcrumb-item"><a href="{{url('/post/apply/candidate/'.$id)}}">All Candidates</a>

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

                  <a href="{{url('/post/apply/candidate/'.$id)}}">

                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>

                  </a>

                  <h4 class="form-section" align="center">Add New Candidate</h4>

                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>

                <div class="card-content collapse show">

                  <div class="card-body">

                    <div class="card-text">

                    <form class="form" id="form" method="POST" action="{{url('/add/candidate/info')}}" enctype="multipart/form-data" novalidate>

                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <input type="hidden" name="job_id" value="{{$id}}">

                      <h4 class="form-section"><i class="icon-eye"></i>Other Info</h4>

                      <div class="form-body">

                        <div class="row">

                         <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Applied For Desired Post</label>

                              <div class="controls">

                              <select id="apply_post" value="{{ old('apply_post') }}"  name="apply_post" class="form-control"  required data-validation-required-message="This field is required">

                                  <option value="">Select Desired Post</option>

                                @foreach($jobType as $jobtyps)

                                  <option value="{{$jobtyps->job_type_id}}">{{$jobtyps->type_name}}</option>

                                @endforeach()

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Select Test City</label>

                              <div class="controls">

                              <select id="select_city" value="{{ old('select_city') }}"  name="select_city" class="form-control" required data-validation-required-message="This field is required" >

                                  <option value="">Select Test City</option>

                                  @foreach($allCity as $allCities)

                                    <option value="{{$allCities->city_id}}">{{$allCities->city_name}}</option>

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

                                  <option value="">Select Bank</option>

                                  <option value="HBL">HBL</option>

                                  <option value="UBL">UBL</option>

                                  <option value="ABL">ABL</option>

                               </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Bank & brach code</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="branch_code" type="text" placeholder="Branch Code" id="branch_code"  value="{{ old('branch_code') }}" >

                              </div>

                            </div>

                          </div>



                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Deposit Date</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="deposit_date" type="date" placeholder="Deposit Date" id="deposit_date"  value="{{ old('deposit_date') }}">

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>

                    <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>

                      <div class="form-body">

                        <div class="row">

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput1">Name</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="name" type="text" placeholder="Full Name" id="name"  value="{{ old('name') }}" required data-validation-required-message="This field is required">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput2">Father Name</label>

                              <div class="controls">

                               <input class="form-control border-primary" name="father_name" type="text" placeholder="Father Name" id="father_name" value="{{ old('fahter_name') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label for="userinput1">CNIC</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="cnic" maxlength="13" minlength="13" type="text" onkeyup="confirmCNIC();" placeholder="CNIC" id="cnic"  value="{{ old('cnic') }}" required>

                              </div>

                            </div>

                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="userinput1">Confirm CNIC</label>
                                <div class="controls">
                                    <input class="form-control border-primary" name="confirm_cnic" maxlength="13" minlength="13" type="text"  placeholder="Confirm CNIC" id="confirm_cnic" onkeyup="confirmCNIC();" value="{{ old('confirm_cnic') }}" required>
                                    <span id="match-text"></span>
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

                                  <option value="Male">Male</option>

                                  <option value="Female">female</option>

                              </select>

                              </div>

                            </div>

                          </div>

                        <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Date Birth</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="date_birth" type="date" placeholder="Date Of Birth" id="date_birth"  value="{{ old('date_birth') }}">

                              </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput2">Marital Status</label>

                              <div class="controls">

                              <select id="marital_status" value="{{ old('marital_status') }}"  name="marital_status" class="form-control"  >

                                  <option value="Unmarried">Unmarried</option>

                                  <option value="Married">Married</option>

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

                              <select id="g_servent" value="{{ old('g_servent') }}"  name="g_servent" class="form-control"  >

                                  <option value="No">No</option>

                                  <option value="Yes">Yes</option>

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">2. Are You a Disabled person?</label>

                              <div class="controls">

                              <select id="d_person" value="{{ old('d_person') }}"  name="d_person" class="form-control"  >

                                  <option value="NO">No</option>

                                  <option value="Yes">Yes</option>

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

                                  <option value="muslim">Muslim</option>

                                  <option value="nonmuslim">Non Muslim</option>

                              </select>

                            </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label for="userinput2">Permanent Address</label>

                              <div class="controls">

                              <textarea class="form-control border-primary" name="permanent_address"  placeholder="Permanent Address" id="permanent_address"  value="{{ old('permanent_address') }}" ></textarea>

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-6">

                            <div class="form-group">

                                <label for="userinput2">Mailing Address</label>

                                <div class="controls">

                                <textarea class="form-control border-primary" name="mailing_address"  placeholder="Mailing Address" id="mailing_address"  value="{{ old('mailing_address') }}" ></textarea>

                                </div>

                            </div>

                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="userinput1">Phon No(optional)</label>
                              <div class="controls">
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                <span class="input-group-text">+92</span>
                              </div>
                               <input type="text" class="form-control border-primary" name="phone_no" type="text" placeholder="Phone No e.g(3410200604)" id="phone_no"  value="{{ old('phone_no') }}" >
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                                <label for="userinput2">Residential</label>

                                <div class="controls">

                                <input class="form-control border-primary" name="residential" type="text" placeholder="Residential" id="residential"  value="{{ old('residential') }}" >

                                </div>

                            </div>

                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">Mobile No</label>

                              <div class="controls">

                              <div class="input-group">

                                <div class="input-group-prepend">

                                  <span class="input-group-text">+92</span>

                                </div>

                                <input type="text" class="form-control border-primary" name="mobile_no" type="text" placeholder="Mobile No e.g(3410200604)" id="mobile_no"  value="{{ old('mobile_no') }}" maxlength="10" minlength="10" required data-validation-required-message="This field is required">

                              </div>



                              </div>

                            </div>

                          </div>

                           <div class="col-md-4">

                            <div class="form-group">

                              <label for="userinput1">District Local Domicile</label>

                              <div class="controls">

                              <input class="form-control border-primary" name="domicile" type="text" placeholder="Domicile Name" id="domicile"  value="{{ old('domicile') }}" >

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

                              <option value="">Select Province</option>

                              @foreach($allProvince as $allProvinces)

                              <option value="{{$allProvinces->pro_id}}">{{$allProvinces->pro_name}}</option>

                              @endforeach()

                              </select>

                              </div>

                            </div>

                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                                <label for="userinput2">Picture</label>

                                <div class="controls">

                                <input class="form-control border-primary" name="picture" type="file" placeholder="Picture" id="picture"  value="{{ old('picture') }}" >

                                </div>
                                <!-- <div id="myOnlineCamera">
                                  <video></video>
                                  <canvas></canvas>
                                  <button class="btn btn-success">Take Photo!</button>
                              </div> -->

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

                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" type="text" id="matric" name="matric"  value="Matric" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                          <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="matric_degree_name" type="text" id="matric_degree_name"  value="{{ old('degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_major_subject" type="text"  id="matric_major_subject" value="{{ old('matric_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_passing_year" type="text"  id="matric_passing_year" value="{{old('matric_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_obtained_marks" type="text"  id="matric_obtained_marks" value="{{old('matric_obtained_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_total_marks" type="text"  id="matric_total_marks" value="{{old('matric_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="matric_institute" type="text" id="matric_institute" value="{{old('matric_institute')}}">

                              </div>

                            </div>

                          </div>

                        </div>

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

                              <input class="form-control border-primary" name="intermediate_degree_name" type="text" id="intermediate_degree_name"  value="{{ old('intermediate_degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_major_subject" type="text" id="intermediate_major_subject" value="{{ old('intermediate_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_passing_year" type="text"

                               id="intermediate_passing_year" value="{{old('intermediate_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_marks" type="text"  id="intermediate_marks" value="{{old('intermediate_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_total_marks" type="text"  id="intermediate_total_marks" value="{{old('intermediate_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="intermediate_institute" type="text"  id="intermediate_institute" value="{{old('intermediate_institute')}}">

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

                              <input class="form-control border-primary" name="bachelors_degree_name" type="text" id="bachelors_degree_name"  value="{{ old('bachelors_degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_major_subject" type="text" id="bachelors_major_subject" value="{{ old('bachelors_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_passing_year" type="text"

                               id="bachelors_passing_year" value="{{old('bachelors_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_marks" type="text"  id="bachelors_marks" value="{{old('bachelors_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_total_marks" type="text"  id="bachelors_total_marks" value="{{old('bachelors_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="bachelors_institute" type="text"  id="bachelors_institute" value="{{old('bachelors_institute')}}">

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

                              <input class="form-control border-primary" name="masters_degree_name" type="text" id="masters_degree_name"  value="{{ old('masters_degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_major_subject" type="text" id="masters_major_subject" value="{{ old('masters_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_passing_year" type="text"

                               id="masters_passing_year" value="{{old('masters_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_marks" type="text"  id="masters_marks" value="{{old('masters_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_total_marks" type="text"  id="masters_total_marks" value="{{old('masters_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="masters_institute" type="text"  id="masters_institute" value="{{old('masters_institute')}}">

                              </div>

                            </div>

                          </div>

                        </div>

                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary qulification"   id="professional1" name="professional1"  value="professional_qualification1" readonly="true" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="professional1_degree_name" type="text" id="professional1_degree_name"  value="{{ old('professional1_degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_major_subject" type="text" id="masters_major_subject" value="{{ old('professional1_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_passing_year" type="text"

                               id="professional1_passing_year" value="{{old('professional1_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_marks" type="text"  id="professional1_marks" value="{{old('professional1_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_total_marks" type="text"  id="professional1_total_marks" value="{{old('professional1_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional1_institute" type="text"  id="professional1_institute" value="{{old('professional1_institute')}}">

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="row proffissional">

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary"  type="hidden" id="professional2" name="professional2"  value="professional_qualification2" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="professional2_degree_name" type="text" id="professional2_degree_name"  value="{{ old('professional2_degree_name') }}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_major_subject" type="text" id="professional2_major_subject" value="{{ old('professional2_major_subject') }}" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_passing_year" type="text"

                               id="professional2_passing_year" value="{{old('professional2_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_marks" type="text"  id="professional2_marks" value="{{old('professional2_passing_year')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_total_marks" type="text"  id="professional2_total_marks" value="{{old('professional2_total_marks')}}">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="professional2_institute" type="text"  id="professional2_institute" value="{{old('professional2_institute')}}">

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

                              <input class="form-control border-primary" name="employer_name" type="text" id="employer_name"  >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title" type="text" id="job_title" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from" type="date"  id="job_from" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to" type="date"  id="job_to" >

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

                              <input class="form-control border-primary" name="employer_name2" type="text" id="employer_name2"  >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title2" type="text" id="job_title2" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from2" type="date"  id="job_from2" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to2" type="date"  id="job_to2" >

                              </div>

                            </div>

                          </div>

                        </div>



                      <div class="row">

                          <div class="col-md-1">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="no3" value="3" readonly="true">

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="employer_name3" type="text" id="employer_name3"  >

                              </div>

                            </div>

                          </div>

                         <div class="col-md-2">

                            <div class="form-group">

                              <div class="controls">

                              <input class="form-control border-primary" name="job_title3" type="text" id="job_title3" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_from3" type="date"  id="job_from3" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <div class="controls">

                               <input class="form-control border-primary" name="job_to3" type="date"  id="job_to3" >

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

                               <input class="form-control border-primary" name="days" type="number" placeholder="Days" id="days"  >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Months</label>

                              <div class="controls">

                               <input class="form-control border-primary" placeholder="Months" name="months" type="number" id="months" >

                              </div>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label for="userinput2">Years</label>

                              <div class="controls">

                               <input class="form-control border-primary" name="years" type="number" placeholder="Years" id="years"  >

                              </div>

                            </div>

                          </div>

                        </div>

                      <h4 class="form-section"><i class="icon-eye"></i>Checking Document</h4>

                      <div class="form-group">

                          <div class="c-inputs-stacked">

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="photo" class="custom-control-input" id="photo">

                              <label class="custom-control-label" for="photo">Two Photographs</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="educational_certificates" class="custom-control-input" id="educational_certificates">

                              <label class="custom-control-label" for="educational_certificates">educational certificates</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="domicile_cnic" class="custom-control-input" id="domicile_cnic">

                              <label class="custom-control-label" for="domicile_cnic">Domicile/CNIC copy</label>

                            </div>

                            <div class="custom-control custom-checkbox">

                              <input type="checkbox" name="bank_slip" class="custom-control-input" id="bank_slip">

                              <label class="custom-control-label" for="bank_slip">Original Bank Deposit Slip</label>

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

                                  <select  class="form-control border-primary" name="status"  placeholder="status" id="status"  value="{{ old('status') }}"  required data-validation-required-message="This field is required" >

                                  <option value="">Select Candidate Status</option>

                                  <option value="Eligible">Eligible</option>

                                  <option value="NotEligible">NotEligible</option>

                                  <option value="Rejected">Rejected</option>

                                  </select>

                                  </div>

                              </div>

                            </div>

                        </div>

                      </div>

                      <div class="form-actions right">

                      <a href="{{url('/post/apply/candidate/'.$id)}}">

                        <button type="button" class="btn btn-warning mr-1">

                          <i class="ft-x"></i> Cancel

                        </button>

                      </a>

                      <button type="submit" class="btn btn-success"  >

                        <i class="la la-check-square-o" ></i> Save

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

                                  <h4 class="modal-title white" id="myModalLabel10">Confirmation message</h4>

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



<script src="{{asset('adminassets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"

    type="text/javascript"></script>



<script src="{{asset('adminassets/app-assets/js/scripts/forms/validation/form-validation.js')}}"

  type="text/javascript"></script>



<script src="{{asset('adminassets/app-assets/vendors/js/forms/select/selectize.min.js')}}" type="text/javascript"></script>



<script src="{{asset('adminassets/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>



<script src="{{asset('adminassets/app-assets/js/scripts/modal/components-modal.js')}}" type="text/javascript"></script>





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



<script type="text/javascript">

var videoObj    = { "video": true },
    errBack        = function(error){
        // alert("Video capture error: ", error.code);
    };

// Ask the browser for permission to use the Webcam
if(navigator.getUserMedia){                    // Standard
    navigator.getUserMedia(videoObj, startWebcam, errBack);
}else if(navigator.webkitGetUserMedia){        // WebKit
    navigator.webkitGetUserMedia(videoObj, startWebcam, errBack);
}else if(navigator.mozGetUserMedia){        // Firefox
    navigator.mozGetUserMedia(videoObj, startWebcam, errBack);
};

function startWebcam(stream){

    var myOnlineCamera    = getElementById('myOnlineCamera'),
        video            = myOnlineCamera.querySelectorAll('video'),
        canvas            = myOnlineCamera.querySelectorAll('canvas');

    video.width = video.offsetWidth;

    if(navigator.getUserMedia){                    // Standard
        video.src = stream;
        video.play();
    }else if(navigator.webkitGetUserMedia){        // WebKit
        video.src = window.webkitURL.createObjectURL(stream);
        video.play();
    }else if(navigator.mozGetUserMedia){        // Firefox
        video.src = window.URL.createObjectURL(stream);
        video.play();
    };

    // Click to take the photo
    $('#webcam-popup .takephoto').click(function(){
        // Copying the image in a temporary canvas
        var temp = document.createElement('canvas');

        temp.width  = video.offsetWidth;
        temp.height = video.offsetHeight;

        var tempcontext = temp.getContext("2d"),
            tempScale = (temp.height/temp.width);

        temp.drawImage(
            video,
            0, 0,
            video.offsetWidth, video.offsetHeight
        );

        // Resize it to the size of our canvas
        canvas.style.height    = parseInt( canvas.offsetWidth * tempScale );
        canvas.width        = canvas.offsetWidth;
        canvas.height        = canvas.offsetHeight;
        var context        = canvas.getContext("2d"),
            scale        = canvas.width/temp.width;
        context.scale(scale, scale);
        context.drawImage(bigimage, 0, 0);
    });
};



  function confirmCNIC() {
    var cnic = document.getElementById('cnic').value;
    var confirm_cnic = document.getElementById('confirm_cnic').value;
    if (cnic === confirm_cnic) {
      document.getElementById('match-text').innerHTML = "<span style='color:green;font-size:92%;'>Matched</span>";
    } else {
      document.getElementById('match-text').innerHTML = "<span style='color:red;font-size:92%'>Not Matched</span>";
    }
  }

  function addItem1() {

              if($('#select_city').val()==''){
               var  test_city="Test city is not mentioned";
              }else{
               var  test_city="no";
              }

              if($('#apply_post').val()==''){
               var desired_post="Desired post not mentioned";
              }else{
               var desired_post="no"
              }

              if($('#branch_code').val()==''){
                var branch_code="Branch code field missing";
              }else{
                var branch_code="no";
              }

              if($('#deposit_date').val()==''){
                var deposit_date="Deposit date missing";
              }else{
                var deposit_date="no";
              }

              if($('#name').val()==''){
                var name="Name field are missing";
              }else{
                var name="no";
              }

              if($('#father_name').val()==''){
                var father_name="Father name field are missing";
              }else{
                var father_name="no";
              }

              var nic=($('#cnic').val()).length;
              if($('#cnic').val()==''){
                  var cnic="CNIC field are missing";
              }else if(nic!=13){
                 var cnic="CNIC is wrong";
              }
              else{
                 var cnic="no";
              }

              if($('#mailing_address').val()==''){
                var mailing_address="Mailing address field are missing";
              }else{
                var mailing_address="no";
              }

              if($('#mobile_no').val()==''){
                var mobile_no="Mobile number field missing";
              }else{
                var mobile_no="no";
              }

              if($('#domicile').val()==''){
                var domicile="Domicile field are missing";
              }else{
                var domicile="no";
              }

              if($('#province').val()==''){
                var province="Province field are missing";
              }else{
                var province="no";
              }

              if($('#picture').val()==''){
                var picture="Picture field are missing";
              }else{
                var picture="no";
              }
              var educational_certificates=$('#educational_certificates').val();
              var domicile_cnic=$('#domicile_cnic').val();
              var bank_slip=$('#bank_slip').val();

              if($("#photo").prop('checked') == false){
                var photo="Two photographs missing";
              }else{
                var photo="no";
              }

              if($("#educational_certificates").prop('checked') == false){
                var educational="Educational certificates missing";
              }else{
                var educational="no";
              }

              if($("#domicile_cnic").prop('checked') == false){
               var cnic_domicile="Domicile Or CNIC photo copy missing";
              }else{
                var cnic_domicile="no";
              }

              if($("#bank_slip").prop('checked') == false){
                var bank_slip="Bank slip are missing";
              }else{
                var bank_slip="no";
              }
              var  checking_document = [];
              checking_document.length=0;
                   checking_document = [test_city,desired_post,branch_code,deposit_date,name,father_name,cnic,mailing_address,mobile_no,domicile,province,picture,photo,educational,cnic_domicile,bank_slip];

              $.each(checking_document, function(index, value){
                    if(value!="no"){
                      $("#missing_field").append(index+ 1 + ": " + value + '<br>');
                    }
              });
              event.preventDefault();
              $('#default').modal('show');
  }
</script>

<script type="text/javascript">
  $(document).ready(function(){
              $('#reject').click(function(){
                  $("#missing_field").empty();
              });
  });
</script>



<script type="text/javascript">

    $(document).ready(function(){
      $('.proceed').click(function(){
        $('#form').submit();
      });
    });

</script>





@endsection()
