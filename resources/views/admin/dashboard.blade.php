@extends('admin.app')

@section('title', 'Dashboard')
 
@section('stylesheets')
  
@endsection

@section('content')

<div class="container">
  <div class="row">
      <div class="col-xl-12 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-center">
                  <h1>Welcome to RTS Managment Panel</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 {{-- <div class="row">
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="info">{{number_format($data['allProject'])}}</h3>
                  <h6>Total Projects </h6>
                </div>
                <div>
                  <i class="la la-briefcase info font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="warning">{{number_format($data['allCity'])}}</h3>
                  <h6>Total Test Cities</h6>
                </div>
                <div>
                  <i class="icon-pointer warning font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger">{{number_format($data['totalTestCenter'])}}</h3>
                  <h6>Total Test Center</h6>
                </div>
                <div>
                  <i class="icon-home danger font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="success">{{number_format($data['totalCandidate'])}}</h3>
                  <h6>Register Candidates</h6>
                </div>
                <div>
                  <i class="icon-user-follow success font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Projects Charts</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div class="card-body">
                    <div id="line-chart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <div class="row">
          <div id="recent-transactions" class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Recent Project</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

              </div>
              <div class="card-content">
                <div class="table-responsive">
                  <table id="recent-orders" class="table table-hover table-xl mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">S.No</th>
                        <th class="border-top-0">Ad Title</th>
                        <th class="border-top-0">Last Date Submission</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-truncate">1</td>
                        <td class="text-truncate">District & Sessions Courts Rawalpindi</td>
                        <td class="text-truncate">
                         2018-11-23
                        </td>
                      </tr>                
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> --}}
       
</div>

@endsection
@section('scripts')

   <script src="https://www.google.com/jsapi" type="text/javascript"></script>

 {{--   <script src="{{asset('public/adminassets/app-assets/js/scripts/charts/google/line/line.js')}}" type="text/javascript"></script> --}}

   <script type="text/javascript">
     // Load the Visualization API and the corechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawLine);

          // Callback that creates and populates a data table, instantiates the line chart, passes in the data and draws it.
          function drawLine() {

              // Create the data table.
              var data = google.visualization.arrayToDataTable([
                  ['Year', 'Projects'],
              @foreach($yearlySaleReports as $yearlySaleReport)

                  ['{{$yearlySaleReport->YEAR}}',  {{$yearlySaleReport->ad}}],

              @endforeach()
                
              ]);


              // Set chart options
              var options_line = {
                  height: 400,
                  fontSize: 12,
                  curveType: 'function',
                  colors: ['#37BC9B', '#DA4453'],
                  pointSize: 5,
                  chartArea: {
                      left: '5%',
                      width: '90%',
                      height: 350
                  },
                  vAxis: {
                      gridlines:{
                          color: '#e9e9e9',
                          count: 10
                      },
                      minValue: 0
                  },
                  legend: {
                      position: 'top',
                      alignment: 'center',
                      textStyle: {
                          fontSize: 12
                      }
                  }
              };

              // Instantiate and draw our chart, passing in some options.
              var line = new google.visualization.LineChart(document.getElementById('line-chart'));
              line.draw(data, options_line);

          }


          // Resize chart
          // ------------------------------

          $(function () {

              // Resize chart on menu width change and window resize
              $(window).on('resize', resize);
              $(".menu-toggle").on('click', resize);

              // Resize function
              function resize() {
                  drawLine();
              }
          }); 

   </script>
@endsection()