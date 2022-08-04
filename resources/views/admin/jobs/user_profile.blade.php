@extends('admin.app')

@section('title', 'Admin|User Details')

@section('stylesheets')

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">

@endsection

@section('content')

<div class="content-body">

      <div class="content-header row">

        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

          <h3 class="content-header-title mb-0 d-inline-block">Cadidate</h3>

          <div class="row breadcrumbs-top d-inline-block">

            <div class="breadcrumb-wrapper col-12">

              <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>

                    </li>

                <li class="breadcrumb-item"><a href="{{url('/post/apply/candidate',$candidateInfo->job_id)}}">All Candidate</a>

                </li>

                <li class="breadcrumb-item active">Cadidate Details

                </li>

              </ol>

            </div>

          </div>

        </div>

      </div>

      <div class="content-body">

        <section class="card">

          <div id="invoice-template" class="card-body">

            <!-- Invoice Company Details -->

                <div class="card-header">

                  <a href="{{url('/post/apply/candidate',$candidateInfo->job_id)}}">

                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>

                  </a>

                  <h4 class="form-section" align="center">Cadidate Details</h4>

                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>

            <!-- Invoice Items Details -->

            <div class="card-body">

                  <h4 class="form-section" style="font-weight: 800;">Other Information:</h4>

                  <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                      <thead>

                      </thead>

                      <tbody>

                        <tr>

                        <th scope="row">

                        1.Are You Government Servant?

                        </th>

                        <td>{{$candidateInfo->g_servent}}

                        </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          2.Are You a Disabled person?                        

                          </th>

                          <td>{{$candidateInfo->disabled}}</td>

                        </tr>

                        <tr>

                          <th scope="row">

                          3.Test City:

                          </th>

                          <td>@if($candidateInfo->testCity) {{$candidateInfo->testCity->city_name}}  @endif

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          4.Applied for Desired position:

                          </th>

                          <td>{{$candidateInfo->desiredPost->type_name}}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                        5. Bank & brach code

                          </th>

                          <td>{{$candidateInfo->bank_code}}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                           6.Deposit Date

                          </th>

                          <td>{{$candidateInfo->deposit_date}}

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

            </div>

            <div class="card-body">

                   <h4 class="form-section" style="font-weight: 800;">Personal Information:</h4>

                  <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                      <thead>

                      </thead>

                      <tbody>

                        <tr>

                            <th scope="row">

                             6.Name

                            </th>

                            <td>{{$candidateInfo->full_name}}

                            </td>

                        </tr>

                        <tr>

                            <th scope="row">

                            7.Father Name

                            </th>

                            <td>{{$candidateInfo->father_name}}

                            </td>

                        </tr>

                        <tr>

                            <th scope="row">

                            8. CNIC

                            </th>

                            <td>{{$candidateInfo->nic}}

                            </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          9. Gender

                          </th>

                          <td>{{$candidateInfo->gender}}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          10.Date Of Birth

                          </th>

                          <td>{{ $candidateInfo->date_of_birth }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          11. Marital Status

                          </th>

                          <td>{{ $candidateInfo->marital_status }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          12. Religion

                          </th>

                          <td>@if($candidateInfo->religion=="muslim")Muslim

                            @else

                            Non Muslim

                            @endif

                          </td>

                        </tr>

                        <tr>

                        <th scope="row">

                          13. Permanent Address:

                          </th>

                          <td>{{ $candidateInfo->postal_address }}

                          </td>

                        </tr>

                          <tr>

                          <th scope="row">

                          14. Permanent Address:

                          </th>

                          <td>{{ $candidateInfo->mailing_address }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          15. Phone No:

                          </th>

                          <td>{{ $candidateInfo->phone_no }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          16. Residential:

                          </th>

                          <td>{{ $candidateInfo->residential }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          17. Mobile:

                          </th>

                          <td>{{ $candidateInfo->mobile_no }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          18. District of Local/Domicile:

                          </th>

                          <td>{{ $candidateInfo->domicile }}

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          19.Province:

                          </th>

                          <td>@if($candidateInfo->provinces) {{$candidateInfo->provinces->pro_name}} @endif

                          </td>

                        </tr>

                        <tr>

                          <th scope="row">

                          19.Picture:

                          </th>

                          <td><img src="{{asset('public/public/candidatepicture/')}}/{{$candidateInfo->upload_image}}" width="40px" class="" />

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

            </div>

          <div class="card-body">

            <h4 class="form-section" style="font-weight: 800;">20.Academic Information:</h4>

            <div class="table-responsive">

                  <table class="table table-bordered mb-0">

                    <thead>

                      <tr>

                        <th>Certificate /Degree Level</th>

                        <th>Degree Name</th>

                        <th>Major Subject</th>

                        <th>Passing Year</th>

                        <th>Obtained Marks/CGPA</th>

                        <th>Total Marks/CGPA</th>

                        <th>Board University</th>

                      </tr>

                    </thead>

                    <tbody>

                      <tr>

                        <th scope="row">Matric</th>

                        <td scope="row">{{$candidateInfo->academic->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->academic->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->academic->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->academic->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->academic->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->academic->board_university}}</td>

                      </tr>

                        <tr>

                        <th scope="row">Intermediate</th>

                        <td scope="row">{{$candidateInfo->intermediate->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->intermediate->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->intermediate->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->intermediate->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->intermediate->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->intermediate->board_university}}</td>

                      </tr>

                        <tr>

                        <th scope="row">Bachelors</th>

                        <td scope="row">{{$candidateInfo->bachelor->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->bachelor->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->bachelor->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->bachelor->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->bachelor->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->bachelor->board_university}}</td>

                      </tr>

                        <tr>

                        <th scope="row">Masters</th>

                        <td scope="row">{{$candidateInfo->master->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->master->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->master->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->master->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->master->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->master->board_university}}</td>

                      </tr>

                        <tr>

                        <th scope="row">Professional Qualification</th>

                        <td scope="row">{{$candidateInfo->professional1->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->professional1->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->professional1->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->professional1->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->professional1->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->professional1->board_university}}</td>

                      </tr>

                      <tr>

                        <th scope="row">Professional Qualification</th>

                        <td scope="row">{{$candidateInfo->professional2->degree_sanad_title}}</td>

                        <td scope="row">{{$candidateInfo->professional2->specialization_major_subject}}</td>

                        <td scope="row">{{$candidateInfo->professional2->year_passing}}</td>

                        <td scope="row">{{$candidateInfo->professional2->obtained_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->professional2->total_marks_cgpa}}</td>

                        <td scope="row">{{$candidateInfo->professional2->board_university}}</td>

                      </tr>

                    

                    </tbody>

                  </table>

                </div>

              </div>

           <div class="card-body">

            <h4 class="form-section" style="font-weight: 800;">22.Employment Record:</h4>

            <div class="table-responsive">

                  <table class="table table-bordered mb-0">

                    <thead>

                      <tr>

                        <th>S.no</th>

                        <th>Organization / Employer Name</th>

                        <th>Job Title</th>

                        <th>From</th>

                        <th>To</th>

                      </tr>

                    </thead>

                    <tbody>



                      <tr>

                     

                        <th scope="row">1</th>

                        <td scope="row">{{$candidateInfo->employmentRecord->organization_employer_name1}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->job_title1}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_from1}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_to1}}</td>

                       

                      </tr>

                      <tr>



                        <th scope="row">2</th>

                        <td scope="row">{{$candidateInfo->employmentRecord->organization_employer_name2}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->job_title2}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_from2}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_to2}}</td>

                    

                      </tr>

                      <tr>



                        <th scope="row">3</th>

                        <td scope="row">{{$candidateInfo->employmentRecord->organization_employer_name3}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->job_title3}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_from3}}</td>

                        <td scope="row">{{$candidateInfo->employmentRecord->duration_to3}}</td>

                       

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>



              <div class="card-body">

              <h4 class="form-section" style="font-weight: 800;">23.Total Experience:</h4>

              <div class="table-responsive">

                    <table class="table table-bordered mb-0">

                      <thead>

                        <tr>

                          <th>Days</th>

                          <th>Months</th>

                          <th>Years</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td scope="row">{{$candidateInfo->totalExpirence->days}}</td>

                          <td scope="row">{{$candidateInfo->totalExpirence->month}}</td>

                          <td scope="row">{{$candidateInfo->totalExpirence->years}}</td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

         </div>

      </div>

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





@endsection()