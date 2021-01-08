@extends('front.layouts.main')

@section('content')

 
   
    <div class="unit-5 overlay" style="background-image: url('{{asset('front_design/images/hero_1.jpg')}}');">
      <div class="container text-center">
        <h2 class="mb-0">Post a Job</h2>
        <p class="mb-0 unit-6"><a href="{{url('/')}}">Home</a> <span class="sep">></span> <span>Post a Job</span></p>
      </div>
    </div>

    
    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
       
          <div class="col-md-12 col-lg-8 mb-5">
          
            
          
            <form action="{{url('/job')}}" method="POST" class="p-5 bg-white">
              @csrf

              
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Job Title</label>
                  <input value="{{old('title')}}" type="text" name="title" class="form-control" placeholder="eg. Full Stack Frontend">
                  @error('title')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-5">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Company</label>
                  <input value="{{old('company_name')}}" type="text" name="company_name" class="form-control" placeholder="eg. Facebook, Inc.">
                  @error('company_name')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>


              <div class="row form-group">
                <div class="col-md-12"><h3>Job Type</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <select name="job_type" >
                  <option disabled selected >choose job type</option>
                  
                  <option value="full time" {{old('job_type')=="full time" ?'selected':''}}>full time</option>
                  <option value="part time" {{old('job_type')=="part time" ?'selected':''}}>part time</option>
                  <option value="freelance" {{old('job_type')=="freelance" ?'selected':''}}>freelance</option>
                  <option value="internship" {{old('job_type')=="internship" ?'selected':''}}>internship</option>
                  
                  <option value="temproray" {{old('job_type')=="temproray" ? 'selected':''}}>temproray</option>
                  
                  </select>
                  @error('job_type')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12"><h3>Location</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <input type="text" value="{{old('location')}}" name="location" class="form-control" placeholder="New York City">
                  @error('location')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12"><h3>Job Description</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <textarea name="job_details" class="form-control"  cols="30" rows="5">{{old('job_details')}}</textarea>
                  @error('job_details')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12"><h3>Salary</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <input type="number" value="{{old('salary')}}" class="form-control" placeholder="$" name="salary">
                  @error('salary')
                        
                            <p class="text-danger">{{$message}}</p>
                        
                  @enderror
                </div>
              </div>

              <div class="row form-group mb-4">
                <div class="col-md-12"><h3>Category</h3></div>
                <div class="col-md-12 mb-3 mb-md-0">
                  <select name="category_id" >
                  <option disabled selected >choose category name</option>
                  @foreach($categories as $category)
                  <option value="{{$category->id}}" {{(old('category_id') == $category->id ? 'selected' : '')}}>{{$category->name}}</option>
                  @endforeach
                  
                  </select>
                </div>
              </div>



              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Post a Job" class="btn btn-primary  py-2 px-5">
                </div>
              </div>

  
            </form>
          </div>

          
        </div>
      </div>
    </div>

   


   
    


    
@endsection