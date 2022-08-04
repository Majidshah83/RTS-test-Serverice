@extends('admin.app')

@section('title', 'Admin|Results')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/fonts/feather/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/extensions/sweetalert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('adminassets/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
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

        @if(Auth::user()->role=="Superadmin")
        <!-- Revenue, Hit Rate & Deals -->

            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

                <h3 class="content-header-title mb-0 d-inline-block">Projects</h3>

                <div class="row breadcrumbs-top d-inline-block">

                    <div class="breadcrumb-wrapper col-12">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a>

                            </li>

                            <li class="breadcrumb-item"><a href="{{url('/result')}}">Projects</a>

                            </li>

                            <li class="breadcrumb-item active">All Results

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{url('/result')}}">
                            <button type="button" class="btn btn-danger btn-min-width box-shadow-2 mr-1 mb-1"><i class="ft-chevron-left"></i>Back</button>
                        </a>
                        <h4 class="form-section" align="center">Total Results</h4>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered dataex-html5-export">
                                <thead>
                                <tr>
                                    <th width="5%">S.no</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">CNIC</th>
                                    <th width="15%">Project Name</th>
                                    <th width="5%">Post Type</th>
                                    <th width="5%">Marks</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $key=>$result)
                                    <tr>
                                        <td width="5%">{{++$key}}</td>
                                        <td width="10%">{{$result->CandidateInfo->full_name}}</td>
                                        <td width="10%">{{$result->CandidateInfo->nic}}</td>
                                        <td width="15%">{{$result->CandidateInfo->post->ad_title}}</td>
                                        <td width="15%">{{$result->CandidateInfo->post->jobType->type_name}}</td>
                                        <td width="15%">{{$result->marks}}</td>
                                    </tr>
                                @endforeach()
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="result_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...dskfsdsd
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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

        function addCandidateResult(data){
            $('#result_add').modal('show');
        }

    </script>



    <script type="text/javascript">



        function remove(id) {

            swal({

                title: "Are you sure?",

                text: "You are about to delete the candidate info, this procedure is irreversible!",

                icon: "warning",

                buttons: {

                    cancel: {

                        text: "No, cancel plx!",

                        value: null,

                        visible: true,

                        className: "",

                        closeModal: false,

                    },

                    confirm:{

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

                            url:"{{ url('/candidate/delete') }}",

                            data:{id:id},

                            success: function(response){
                                swal("Deleted!", "Your candidate info has been deleted.", "success");
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            }
                        });

                    }else{

                        swal("Cancelled", "Your candidate info is safe", "error");

                    }

                });

        }

    </script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminassets/app-assets/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('adminassets/app-assets/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}"
            type="text/javascript"></script>

@endsection()
