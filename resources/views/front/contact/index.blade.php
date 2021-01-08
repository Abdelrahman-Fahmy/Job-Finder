@extends('front.layouts.main')

@section('content')


<div class="unit-5 overlay" style="background-image:url('{{asset('front_design/images/hero_1.jpg')}}');">
      <div class="container text-center">
        <h2 class="mb-0">Contact</h2>
        <p class="mb-0 unit-6"><a href="{{url('/')}}">Home</a> <span class="sep">></span> <span>Contact</span></p>
      </div>
    </div>

    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
            @if(Session::has('alert-success'))

                <div class="col-md-12">

                    <div class="alert alert-success">
                        <div class="text-success">{{Session::get('alert-success')}}</div>
                    </div>
                </div>
            @endif
       
          <div class="col-md-12 col-lg-8 mb-5">
            <form action="{{url('/contact')}}" method="post" class="p-5 bg-white">
@csrf
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" for="fullname">Full Name</label>
                  <input type="text" name='name' class="form-control" placeholder="Full Name" value="{{old('name')}}">
                  @error('name')
                   
                      <div class="text-danger">{{$message}}</div>
                   
                  @enderror
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                  @error('email')
                   
                      <div class="text-danger">{{$message}}</div>
                   
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="message">Message</label> 
                  <textarea name="message" message="message" cols="30" rows="5" class="form-control" placeholder="Say hello to us">{{old('message')}}</textarea>
                  @error('message')
                   
                      <div class="text-danger">{{$message}}</div>
                    
                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary pill px-4 py-2">
                </div>
              </div>

  
            </form>
          </div>

          
        </div>
      </div>
    </div>

  


@endsection