@extends('front.layouts.main')

@section('content')



<div class="site-blocks-cover overlay" style="background-image: url('{{asset('front_design/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12" data-aos="fade">
            <h1>Find Job</h1>
            <form action="{{url('/jobs')}}">
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <input type="text" value="{{(request()->has('keywords'))?request()->input()['keywords']: ''}}" name="keywords" class="mr-3 form-control border-0 px-4" placeholder="job title">
                    </div>
                    <div class="col-md-6 mb-3 mb-md-0">
                      <div class="input-wrap">
                        <span class="icon icon-room"></span>
                      <input type="text" value="{{(request()->has('location'))?request()->input()['location']: ''}}" name="location" class="form-control form-control-block search-input  border-0 px-4" id="autocomplete" placeholder="city, province or region" onFocus="geolocate()">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" class="btn btn-search btn-primary btn-block" value="Search">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <p class="small">
                  @if($categories->count()===0)
                  <span class="text-warning">there is no categories</span>
                  @else
                  or search by category: 
                  @foreach($categories as $category)<a href="{{url('/jobs/'.$category['id'])}}" class="category mx-2">{{$category->name}}</a>@endforeach 
                  @endif
                  </p>
                 
                </div>
              </div>
             
            
              
            </form>
          </div>
        </div>
      </div>
    </div>
    




<div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            <h2 class="mb-5 h3">All Jobs</h2>
            <div class="rounded border jobs-wrap ">
            <div class="row">
            @if($jobs->count()===0)
              <div class="col-md-12">
              <div class="aler alert-warning p-4">
                <div class="text-warning">there is no jobs</div>
              </div>
              </div>
            @else
            @foreach($jobs as $job)
            <div class="@if(url()->current()=='http://localhost:8000/jobs/posted/list') col-md-10 @else col-md-12 @endif">
              <a href="{{url('job/'.$job['id'])}}" class="job-item d-block d-md-flex align-items-center  border-bottom fulltime">
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                  <img src="{{asset('front_design/images/company_logo_blank.png')}}" alt="Image" class="img-fluid mx-auto">
                </div>
                <div class="job-details h-100">
                  <div class="p-3 align-self-center">
                    <h3> {{$job->title}}</h3>
                    <div class="d-block d-lg-flex">
                      <div class="mr-3"><span class="icon-suitcase mr-1"></span> {{$job->company_name}}</div>
                      <div class="mr-3"><span class="icon-room mr-1"></span> {{$job->location}}</div>
                      <div><span class="icon-money mr-1"></span> {{$job->salary}}</div>
                    </div>
                  </div>
                </div>
                <div class="job-category align-self-center">
                  <div class="p-3">
                    <span class="text-info p-2 rounded border border-info">{{$job->job_type}}</span>
                  </div>
                </div>  
              </a>
              </div>

              @if(url()->current()=="http://localhost:8000/jobs/posted/list")
              <div class="col-md-2 m-auto text-center">
                     <a href="{{url('job/'.$job['id'].'/appliers')}}" class="btn btn-info">appliers</a>  
              </div>      

              @endif
             @endforeach

             
              @endif
              
            </div>
            </div>
          
          </div>
          <div class="col-md-12 mt-4">
              {{$jobs->appends(request()->input())->links()}}
          </div>
        </div>
      </div>
    </div>

@endsection
