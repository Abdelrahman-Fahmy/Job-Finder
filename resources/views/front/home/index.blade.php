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
                      <input type="text" value="{{(request()->has('keywords'))?request()->input()['keywords']: ''}}" name="keywords" class="mr-3 form-control border-0 px-4" placeholder="job title ">
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
                  <span class="text-danger">there is no categories</span>
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
    


    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto text-center mb-5 section-heading">
            <h2 class="mb-5">Popular Categories</h2>
          </div>
        </div>
        <div class="row">
        @if($categories->count()===0)
        <div class="col-md-12 ">
          <div class="aler alert-danger p-4">
            <div class="text-danger">there is no categories</div>
          </div>
        </div>
        @else
        @for($i=0;$i<min(8,count($categories));$i++)
          <div class="col-sm-6 col-md-4 col-lg-3 mb-3" data-aos="fade-up" data-aos-delay="100">
            <a href="#" class="h-100 feature-item">
              <span class="d-block icon flaticon-calculator mb-3 text-primary"></span>
              <h2>{{$categories[$i]['name']}}</h2>
              <span class="counting">{{$categories[$i]->jobs()->count()}}</span>
            </a>
          </div>
         @endfor
         @endif
        </div>

      </div>
    </div>
   


    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            <h2 class="mb-5 h3">Recent Jobs</h2>
            <div class="rounded border jobs-wrap">
            @if($jobs->count()===0)

            <div class="aler alert-danger p-4">
              <div class="text-danger">there is no jobs</div>
          </div>
                
            @else
            @foreach($jobs as $job)
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

            @endforeach
            @endif
            </div>

            <div class="col-md-12 text-center mt-5">
              <a href="{{url('/jobs')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More Jobs</a>
            </div>
          </div>
          <div class="col-md-4 block-16" data-aos="fade-up" data-aos-delay="200">
            <div class="d-flex mb-0">
              <h2 class="mb-5 h3 mb-0">Featured Jobs</h2>
              <div class="ml-auto mt-1"><a href="#" class="owl-custom-prev">Prev</a> / <a href="#" class="owl-custom-next">Next</a></div>
            </div>

            <div class="nonloop-block-16 owl-carousel">
            @foreach($jobs as $job)
              <div class="border rounded p-4 bg-white">
                <h2 class="h5"> {{$job->title}}</h2>
                <p><span class="border border-warning rounded p-1 px-2 text-warning"> {{$job->job_type}}</span></p>
                <p>
                  <span class="d-block"><span class="icon-suitcase"></span>  {{$job->company_name}}</span>
                  <span class="d-block"><span class="icon-room"></span>  {{$job->location}}</span>
                  <span class="d-block"><span class="icon-money mr-1"></span>  {{$job->salary}}</span>
                </p>
                <p class="mb-0"> {{$job->job_details}}</p>
              </div>
            @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>

   

    <div class="site-blocks-cover overlay inner-page" style="background-image: url('{{asset('front_design/images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-center" data-aos="fade">
            <h1 class="h3 mb-0">Your Dream Job</h1>
            <p class="h3 text-white mb-5">Is Waiting For You</p>
            <p><a href="#" class="btn btn-outline-warning py-3 px-4">Find Jobs</a> <a href="#" class="btn btn-warning py-3 px-4">Apply For A Job</a></p>
            
          </div>
        </div>
      </div>
    </div>

    

    <div class="site-section site-block-feature bg-light">
      <div class="container">
        
        <div class="text-center mb-5 section-heading">
          <h2>Why Choose Us</h2>
        </div>

        <div class="d-block d-md-flex border-bottom">
          <div class="text-center p-4 item border-right" data-aos="fade">
            <span class="flaticon-worker display-3 mb-3 d-block text-primary"></span>
            <h2 class="h4">More Jobs Every Day</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
            <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
          </div>
          <div class="text-center p-4 item" data-aos="fade">
            <span class="flaticon-wrench display-3 mb-3 d-block text-primary"></span>
            <h2 class="h4">Creative Jobs</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
            <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
          </div>
        </div>
        <div class="d-block d-md-flex">
          <div class="text-center p-4 item border-right" data-aos="fade">
            <span class="flaticon-stethoscope display-3 mb-3 d-block text-primary"></span>
            <h2 class="h4">Healthcare</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
            <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
          </div>
          <div class="text-center p-4 item" data-aos="fade">
            <span class="flaticon-calculator display-3 mb-3 d-block text-primary"></span>
            <h2 class="h4">Finance &amp; Accounting</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.</p>
            <p><a href="#">Read More <span class="icon-arrow-right small"></span></a></p>
          </div>
        </div>
      </div>
    </div>

    


    






@endsection
