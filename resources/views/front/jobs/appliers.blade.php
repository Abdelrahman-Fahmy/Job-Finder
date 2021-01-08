@extends('front.layouts.main')

@section('content')

<div class="unit-5 overlay" style="background-image: url('{{asset('front_design/images/hero_1.jpg')}}');">
      <div class="container text-center">
        <h2 class="mb-0">Appliers</h2>
        <p class="mb-0 unit-6"><a href="{{url('/')}}">Home</a> <span class="sep">></span> <span>appliers</span></p>
      </div>
    </div>

    
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
      
        @if($appliers==[])
          <div class="col-md-12">
            <div class="alert alert-danger">
              <div class="text-danger">there is no appliers</div>
            </div>
          </div>
        @endif
            @foreach($appliers as $applier)
          <div class="col-md-6 mb-5 mb-lg-4 col-lg-3" data-aos="fade">
            <div class="position-relative unit-8">
            <a href="#" class="mb-3 d-block img-a"><img src="@if($applier->image == null) {{asset('front_design/images/profile.png')}} @else data:image/jpeg;base64,{{$applier->image}} @endif" alt="img" class="img-fluid"></a>
            <span class="d-block text-gray-500 text-normal small mb-3"><a href="#">{{$applier->name}}</a> <span class="mx-2">&bullet;</span> {{$applier->phone}}</span>
            <h2 class="h5 font-weihgt-normal line-height-sm mb-3"><a href="#" class="text-black">{{$applier->email}}</a></h2>
            <p>{{$applier->address}}</p>
            @if($applier->cv != '')
            <a href="{{url('/download/'.$applier->cv)}}" class="btn btn-success">download cv</a>
            @else
            <a href="javascript:;" class="btn btn-warning">no cv</a>
            @endif
            </div>
            
          </div>
          @endforeach
          
        </div>


        


      </div>
    </div>   
@endsection