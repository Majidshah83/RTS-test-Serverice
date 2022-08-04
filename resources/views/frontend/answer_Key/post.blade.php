@extends('frontend.master')
@section('title', 'Answer key')

@section('content')
<style>
.downloadAnswerKey
{
  padding-left:30%;
  color:blue;
}
</style>

<div class="container-fluid without">
    <div class="row align-content-center">
        <div class="page-title">
            <div class="box-overlay">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('index')}}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Download Answer Key</li>
                </ol>
                <h1>Download Answer Key</h1>
            </div>
        </div>
    </div>
</div>

<div class="container custom-mt mt-5" style="
    margin-top: 11%;">    
       <h4 class="downloadAnswerKey"> Download Answer Key </h4>
       <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
                        <th>S.No</th>
                    <th>Apply For</th>
                    <th>Action</th>
        
     
      </tr>
    </thead>
    <tbody>
    @foreach($postTypes as $key => $postType)
    @if(@$postType->answer)
                        <tr>
                            <td><h5>{{++$key}}</h5></td>
                            <td><h5>{{$postType->type_name}}</h5></td>
                            <td>
                                <a href="" class="btn btn-primary" target="_blank">Download Answer Key</a>
                            </td>
                        </tr>
                   @endif
                @endforeach
</tbody>
  </table>
</div>
    </div>

@stop