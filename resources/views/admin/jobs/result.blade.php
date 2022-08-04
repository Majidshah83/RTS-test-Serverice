@extends('admin.app')

 @section('title', 'Admin|Results')



 @section('stylesheets')



  <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">



  <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/fonts/feather/style.css')}}">



  <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/fonts/simple-line-icons/style.min.css')}}">



  <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/extensions/sweetalert.css')}}">



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

          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

              <h3 class="content-header-title mb-0 d-inline-block">Result</h3>

              <div class="row breadcrumbs-top d-inline-block">

                <div class="breadcrumb-wrapper col-12">

                  <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>

                    </li>

                    <li class="breadcrumb-item active">Results

                    </li>

                  </ol>

                </div>

              </div>

            </div>

             <div class="row">

              <div class="col-12">

                <div class="card">

                <div class="card-header">
                  <h4 class="form-section" align="center"></i>Results</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th width="2%">S.no</th>
                          <th width="20%">Project Title</th>
                          <th width="50%"><center>Action</center></th>
                        </tr>
                        </thead>
                      <tbody>
                        @foreach($allProjects as $key=>$allProjects)
                          <tr>
                            <td>{{++$key}}</td>
                            <td>{{$allProjects->ad_title}}</td>
                            <td>
                            <center>
                            <a href="{{url('/project/results',$allProjects->ad_id)}}">
                               <button type="button" class="btn btn-outline-primary" aria-haspopup="true" data-tooltip="tooltip" title="View Result" aria-expanded="false">View Results</button>
                            </a>
                            <a href="{{url('upload/result', $allProjects->ad_id)}}">
                            <button type="button" class="btn btn-outline-info" aria-haspopup="true" data-tooltip="tooltip" title="Upload Result" aria-expanded="false">Upload Result</button>
                            </a>
                            <a href="{{url('update/result', $allProjects->ad_id)}}">
                                <button type="button" class="btn btn-outline-warning" aria-haspopup="true" data-tooltip="tooltip" title="Update Result" aria-expanded="false">Update Result</button>
                            </a>
                            <button type="button" class="btn btn-outline-dark" onclick="ResultStatus({{$allProjects}})" aria-haspopup="true" data-tooltip="tooltip" title="Change Result" aria-expanded="false">Change Status Result</button>
                            </center>
                            </td>
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

             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Result Status Change</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                         <form action="{{url('result/status/change')}}" method="post">
                             {{ csrf_field() }}
                             <div class="row">
                                 <input type="hidden" name="ad_id" id="ad_id" value="">
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <input type="radio" name="result_status" onchange="StatusChange(this.value)" id="enabled_status" value="1"> Enabled<br>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <input type="radio" name="result_status" onchange="StatusChange(this.value)" id="disabled_status" value="0"> Disabaled<br>
                                     </div>
                                 </div>
                             </div>
                             <div class="row" id="result_complete" style="display:none;">
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <input type="checkbox" name="single_result"  id="single_result" value="1" disabled checked> Single<br>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <input type="checkbox" name="complete_result" id="full_result" checked> Full Result<br>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit"  id="dsdsd" class="btn btn-primary">Save changes</button>
                         </div>
                         </form>

                     </div>
                 </div>
             </div>

      </div>



  @endsection

  @section('scripts')



  <script src="{{asset('adminassets/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>





  <script src="{{asset('adminassets/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"

  type="text/javascript"></script>



  <script src="{{asset('adminassets/app-assets/vendors/js/extensions/sweetalert.min.js')}}" type="text/javascript"></script>



  <script src="{{asset('adminassets/app-assets/js/scripts/extensions/sweet-alerts.js')}}" type="text/javascript"></script>



  <script type="text/javascript">

          $(document).ready(function() {

                $('body').tooltip({

                  selector: "[data-tooltip=tooltip]",

                  container: "body"

                });

          });

          function ResultStatus(project){
              $('#ad_id').val(project['ad_id']);
              if(project['result_status'] != 0){
                  document.getElementById("enabled_status").checked = true;
                  $('#result_complete').show();
              }else {
                  document.getElementById("disabled_status").checked = true;
                  $('#result_complete').hide();
              }
              if(project['complete_result'] == 1){
                  document.getElementById("full_result").checked = true;
              }else{
                  document.getElementById("full_result").checked = false;
              }
              $('#exampleModal').modal('show');
          }

          function StatusChange(value){
              value == 1 ? $('#result_complete').show() : $('#result_complete').hide();
          }

  </script>



  <script type="text/javascript">

    function remove(id) {

        swal({

          title: "Are you sure?",

          text: "You are about to delete the result, this procedure is irreversible!",

          icon: "warning",

          buttons: {

                  cancel: {

                      text: "No, cancel plx!",

                      value: null,

                      visible: true,

                      className: "",

                      closeModal: false,

                  },

                  confirm: {

                      text: "Yes, delete it!",

                      value: true,

                      visible: true,

                      className: "",

                      closeModal: false

                  }

          }

      })

      .then((isConfirm) =>{

          if (isConfirm) {

              $.ajax({

                type:"get",

                url:"{{ url('/result/delete') }}",

                data:{id:id},

                success: function(response){

                swal("Deleted!", "Your result has been deleted.", "success");

                setTimeout(function() {

                   location.reload();

                }, 1000);

               }

              });

        }else{

            swal("Cancelled", "Your result is safe", "error");

        }

      });

    }



  </script>





  @endsection()
