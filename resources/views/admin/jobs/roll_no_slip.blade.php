@extends('admin.app')

@section('title', 'Admin|Roll No Slip')

@section('stylesheets')

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/validation/form-validation.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/vendors/css/forms/selects/selectize.default.css')}}">

   <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/adminassets/app-assets/css/plugins/forms/selectize/selectize.css')}}">

@endsection

@section('content')

<div class="content-body">

      <div class="content-header row">

        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">

          <h3 class="content-header-title mb-0 d-inline-block">Roll Slip</h3>

          <div class="row breadcrumbs-top d-inline-block">

            <div class="breadcrumb-wrapper col-12">

              <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>

                    </li>

                <li class="breadcrumb-item"><a href="{{url('/post/apply/candidate',$candidateInfo->job_id)}}">All Candidate</a>

                </li>

                <li class="breadcrumb-item active">Candidate Roll No Slip Details

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

              <h4 class="form-section" align="center" style="font-weight: 800;">Candidate Roll No Slip Details</h4>

              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

            </div>

            <!-- Invoice Items Details -->

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered table-striped">

                  <thead>

                  </thead>

                  <tbody>

                    <tr>

                        <th scope="row">

                        1.Job Title

                        </th>

                        <td colspan="4">{{$candidateInfo->post->ad_title}}

                        </td>

                    </tr>

                     <tr>

                        <th scope="row">

                        2.Post Type

                        </th>

                        <td>{{$candidateInfo->desiredPost->type_name}}

                        </td>

                        <th scope="row">

                        3.Roll No Slip

                        </th>

                        <td>{{$candidateInfo->rollSlip->roll_no_slip}}

                        </td>

                    </tr>

                    <tr>

                        <th scope="row">

                        4.Test Date

                        </th>

                        <td>{{$candidateInfo->rollSlip->test_date}}

                        </td>

                        <th scope="row">

                        5.Test Time

                        </th>

                        <td>{{date('h:i A', strtotime($candidateInfo->rollSlip->test_time)) }}

                        </td>

                    </tr>

                    <tr>

                        <th scope="row">

                        6.Test City

                        </th>

                        <td>@if($candidateInfo->testCity) {{$candidateInfo->testCity->city_name }} @endif

                        </td>

                        <th scope="row">

                        7.Test Center

                        </th>

                        <td>{{$candidateInfo->rollSlip->centerName->center_name }}

                        </td>

                    </tr>

                    <tr>

                        <th scope="row">

                        8.Name

                        </th>

                        <td>{{$candidateInfo->full_name}}

                        </td>

                        <th scope="row">

                        9.Father Name

                        </th>

                        <td>{{$candidateInfo->father_name}}

                        </td>

                    </tr>

                    <tr>

                        <th scope="row">

                        10. CNIC

                        </th>

                        <td>{{$candidateInfo->nic}}

                        </td>

                      <th scope="row">

                        11.Picture

                      </th>

                      <td><img src="{{asset('public/public/candidatepicture/')}}/{{$candidateInfo->upload_image}}" width="40px" class="" />

                      </td>

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