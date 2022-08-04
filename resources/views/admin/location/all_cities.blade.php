@extends('admin.app')
 @section('title', 'Admin|All Cities')
 
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
              <h3 class="content-header-title mb-0 d-inline-block">Cities</h3>
              <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>
                    </li>
                     <li class="breadcrumb-item"><a href="{{url('/location')}}">All Province</a>
                    </li>
                    <li class="breadcrumb-item active">All Cities
                    </li>
                  </ol>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-12">
                <div class="card">
                <div class="card-header">
                  <h4 class="form-section" align="center"></i>{{$province->pro_name}} Cities</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <a href="{{url('/location')}}">
                        <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                  </a>
                  <a href="{{url('/create/cities/'.$province->pro_id)}}">
                    <button type="button" class="btn btn-success btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-plus"></i>Add New Cities</button>
                  </a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead>
                        <tr>
                          <th width="10%">S.no</th>
                          <th width="20%">City Name</th>
                          <th width="30%"><center>Action</center></th>
                        </tr>
                        </thead>
                       <tbody>
                       @foreach($cities as $key=>$allcities)
                          <tr>

                            <td>{{++$key}}</td>
                            <td>{{$allcities->city_name}}</td>
                            <td>
                            <center>   
                            <a href="{{url('/edit/city', $allcities->city_id)}}">
                            <button type="button" class="btn btn-outline-success" aria-haspopup="true" aria-expanded="false">Edit</button>
                            </a>
                            <button type="button" onclick="remove({{$allcities->city_id}})" data-toggle="modal"  class="btn btn-outline-danger" data-tooltip="tooltip" title="Delete">Delete</button>
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
  </script> 

    <script type="text/javascript">
    function remove(id) {
        swal({
          title: "Are you sure?",
          text: "You are about to delete the city, this procedure is irreversible!",
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
                url:"{{ url('/city/delete') }}",
                data:{id:id},
                success: function(response){
                swal("Deleted!", "Your city has been deleted.", "success");
                setTimeout(function() {
                   location.reload();
                }, 1000);
               }
              });
        }else{
            swal("Cancelled", "Your city is safe", "error");
        }  
      });
    }
  
  </script>

 

  @endsection()