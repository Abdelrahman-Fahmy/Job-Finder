@extends('front.layouts.main')


@section('content')


    <div class="unit-5 overlay" style="background-image:url('{{asset('front_design/images/hero_1.jpg')}}');">
      <div class="container text-center">
        <h2 class="mb-0">create profile</h2>
        <p class="mb-0 unit-6"><a href="{{url('/')}}">Home</a> <span class="sep">></span> <span>profile</span></p>
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
       
          <div class="col-md-12 col-lg-6 mb-5">
          
          <h3 class="h5 text-black mb-3">Edit Profile</h3>
          
            <form action="/profile/edit/{{$user->id}}" method="POST" class="px-5 pb-5 bg-white" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}">
                  @error('name')
                    
                        <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" >Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{old('email')}}">
                  @error('email')
                    
                    <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Address</label>
                  <input type="text" name="address" class="form-control" placeholder="Address" value="{{old('address')}}">
                </div>
              </div>



              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Phone</label>
                  <input type="number" name="phone" class="form-control" placeholder="Phone #" value="{{old('phone')}}">
                  @error('phone')
                    
                    <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>


              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Image</label>
                  <input type="file" name="image" class="form-control">
                  @error('image')
                    
                    <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>

              @if(auth()->user()->user_type==1)
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Cv</label>
                  <input type="file" name="cv" class="form-control">
                  @error('cv')
                    
                    <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>
              @endif

              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <label class="font-weight-bold" >Password</label>
                  <input type="text" name="password" class="form-control" placeholder="password" value="{{old('password')}}">

                  @error('password')
                    
                    <div class="text-danger">{{$message}}</div>

                  @enderror
                </div>
              </div>
              


              
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="edit" class="btn btn-primary pill px-4 py-2">
                </div>
              </div>

  
            </form>
          </div>

          <div class="col-lg-6">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">Profile Info</h3>
              

              <p class="mb-0 font-weight-bold">Image</p>
              
              @if($user->image == '')
              <p class="mb-4"><img src="{{asset('front_design/images/profile.png')}}" alt="img" class="img-fluid"></p>
              @else
              <p class="mb-4"><img src="data:image/jpeg;base64,{{$image_url}}" alt="img" class="img-fluid"></p>
              @endif

              <p class="mb-0 font-weight-bold">Name</p>
              <p class="mb-4">{{$user->name}}</p>

              <p class="mb-0 font-weight-bold">Email</p>
              <p class="mb-4"><a href="#">{{$user->email}}</a></p>
              <p class="mb-0 font-weight-bold">Address</p>
                @if($user->address == '')
                <div class="alert alert-warning">
                    <p class="text-warning mb-0">there is no value</p>
                </div>
                @else
                
                <p class="mb-0"><a href="#">{{$user->address}}</a></p>
             
                @endif

                <p class="mb-0 font-weight-bold">Phone</p>
                @if($user->phone == '')
                <div class="alert alert-warning">
                    <p class="text-warning mb-0">there is no value</p>
                </div>
                @else

                <p class="mb-0"><a href="#">{{$user->phone}}</a></p>
              
                @endif
                @if(auth()->user()->user_type==1)
                <p class="mb-0 font-weight-bold">Cv</p>
                @if($user->cv == '')
                <div class="alert alert-warning">
                    <p class="text-warning mb-0">there is no cv</p>
                </div>
                @else

                <p class="mb-0"><a href="{{url('/download/'.$user->cv)}}">{{$user->cv}}</a></p>
              
                @endif
                @endif
            </div>
            
            
          </div>
        </div>
      </div>
    </div>


    


@endsection