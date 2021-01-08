@extends('front.layouts.main')

@section('content')


    <div class="unit-5 overlay" style="background-image: url('{{asset('front_design/images/hero_2.jpg')}}');">
      <div class="container text-center">
        <h2 class="mb-0">{{$job->title}}</h2>
        <p class="mb-0 unit-6"><a href="{{url('/')}}">Home</a> <span class="sep">></span> <span>Job Item</span></p>
      </div>
    </div>

    
    

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
       
          <div class="col-md-12  mb-5">
          
            
          
            <div class="p-5 bg-white">

              <div class="mb-4 mb-md-5 mr-5">
               <div class="job-post-item-header d-flex align-items-center">
                 <h2 class="mr-3 text-black h4">{{$job->title}}</h2>
                 <div class="badge-wrap">
                  <span class="border border-warning text-warning py-2 px-4 rounded">{{$job->job_type}}</span>
                 </div>
               </div>
               <div class="job-post-item-body d-block d-md-flex">
                 <div class="mr-3"><span class="fl-bigmug-line-portfolio23"></span> <a href="#">{{$job->company_name}}</a></div>
                 <div><span class="fl-bigmug-line-big104"></span> <span>{{$job->location}}</span></div>
               </div>
              </div>

          
              <p>{{$job->job_details}}</p>
              @auth        
              @if(auth()->user()->user_type == 1)
            
              @if( $applied->applied == 0 )
              <p class="mt-5 d-inline-block"><a href="javascript:;" class="btn btn-primary  py-2 px-4 apply">Apply Job</a></p>
              @else
              <p class="mt-5 d-inline-block"><a href="javascript:;" class="btn btn-info  py-2 px-4 ">already applied</a></p>
              @endif

              @if( $applied->liked == 0 )
              <p class="mt-5 d-inline-block"><a href="javascript:;" class="btn btn-primary  py-2 px-4 like">like</a></p>
              @else
              <p class="mt-5 d-inline-block"><a href="javascript:;" class="btn btn-info  py-2 px-4 ">liked</a></p>
              @endif
            @else
            <p class="mt-5"><a href="javascript:;" class="btn btn-danger py-2 px-4 ">cant apply</a></p>
            @endif
            @endauth
            </div>
          </div>
         
          <input type="hidden" id="job_id" value="{{$job->id}}">

          
        </div>
      </div>
    </div>

   

     
 

@endsection

@push('scripts')

<script>

$(function(){
  $('.apply').click(function(){
      //var user_id=$('#user_id').val();
      let job_id=$('#job_id').val();
      let self=$(this);
      let data = {
        //'user_id':user_id,
        'job_id':job_id,
        '_token':'{{csrf_token()}}'
      }
      
      // $.post("{{url('/job/apply')}}",data,function(data,status){
      //   alert('success');
      // });

      $.ajax({
        method:'POST',
        url:'/job/apply',
        data:data,
        success:function(response){
          alert('success');
          self.addClass('btn btn-info');
          self.text('already applied');
          self.unbind();
        },
        error:function(jqXHR,textStatus,errorThrown){
          console.log(JSON.stringify(jqXHR));
          console.log("ajax error: "+textStatus+' : '+errorThrown);
        }
      });
  });


  $('.like').click(function(){
      //var user_id=$('#user_id').val();
      let job_id=$('#job_id').val();
      let self=$(this);
      let data = {
        //'user_id':user_id,
        'job_id':job_id,
        '_token':'{{csrf_token()}}'
      }
      
      // $.post("{{url('/job/apply')}}",data,function(data,status){
      //   alert('success');
      // });

      $.ajax({
        method:'POST',
        url:'/job/like',
        data:data,
        success:function(response){
          alert('success');
          self.addClass('btn btn-info');
          self.text('liked');
          self.unbind();
        },
        error:function(jqXHR,textStatus,errorThrown){
          console.log(JSON.stringify(jqXHR));
          console.log("ajax error: "+textStatus+' : '+errorThrown);
        }
      });
  });

});

</script>

@endpush