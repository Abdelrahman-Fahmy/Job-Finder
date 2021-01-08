<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Job Finder &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('front_design/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('front_design/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('front_design/css/animate.css')}}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    
    
    
    <link rel="stylesheet" href="{{asset('front_design/fonts/flaticon/font/flaticon.css')}}">
  
    <link rel="stylesheet" href="{{asset('front_design/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('front_design/css/style.css')}}">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    
    <div class="site-navbar-wrap js-site-navbar bg-white">
      
      <div class="container">
        <div class="site-navbar bg-light">
          <div class="py-1">
            <div class="row align-items-center">
              <div class="col-2">
                <h2 class="mb-0 site-logo"><a href="{{url('/')}}">Job<strong class="font-weight-bold">Finder</strong> </a></h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                      <li><a href="{{url('/')}}" @if($page =='home') class="active" @endif>Home</a></li>
                      <li class="has-children">
                      @auth
                      @if(auth()->user()->user_type==0)
                        <a href="javascript:;">For Employers</a>
                        <ul class="dropdown arrow-top">
                          <li><a href="{{url('/profile/edit')}}" @if($page =='profile') class="active" @endif>profile</a></li>
                          
                          
                          <li><a href="{{url('jobs/posted/list')}}" @if($page =='myjobs') class="active" @endif>myjobs</a></li>
                          
                        </ul>
                        @elseif(auth()->user()->user_type==1)
                        <a href="javascript:;">For Employees</a>
                        <ul class="dropdown arrow-top">
                          <li><a href="{{url('/profile/edit')}}" @if($page =='profile') class="active" @endif>profile</a></li>
                          <li><a href="{{url('/jobs')}}" @if($page =='search jobs') class="active" @endif>Search For Job</a></li>
                          <li><a href="{{url('/jobs/apply/list')}}" @if($page =='applylist') class="active" @endif>Applied List</a></li>
                          <li><a href="{{url('/jobs/liked/list')}}" @if($page =='myfavourites') class="active" @endif>My Favourites</a></li>
                          
                        </ul>
                        @endif
                        @endauth
                      </li>

                      @auth
                      @if(auth()->user()->user_type !=2 )
                      <li><a href="{{url('/contact')}}"  @if($page =='contact') class="active" @endif>Contact</a></li>
                      @else
                      <li><a href="{{url('/admin')}}">adminPanel</a></li>
                      @endif
                      @endauth
                      @guest
                      <li><a href="{{url('login')}}">login</a></li>
                      <li><a href="{{url('register')}}">register</a></li>
                      @else
                      <li>welcome {{auth()->user()->name}}</li>
                      <li><a href="#" onclick="document.getElementById('logout_form').submit();">logout</a>
                      <form action="{{url('logout')}}" method="POST" id="logout_form">
                      {{csrf_field()}}
                      </form>
                      </li>
                      @endguest
                      @auth
                      @if(auth()->user()->user_type==0)
                      <li><a href="{{url('/job/create')}}"><span class="bg-primary text-white py-3 px-2 rounded"><span class="icon-plus mr-3"></span>Post New Job</span></a></li>
                      @endif
                      @endauth
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div style="height: 113px;"></div>

   @yield('content')
    
    <footer class="site-footer">
      <div class="container">
        

        <div class="row">
          <div class="col-md-4">
            <h3 class="footer-heading mb-4 text-white">About</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat quos rem ullam, placeat amet.</p>
            <p><a href="#" class="btn btn-primary pill text-white px-4">Read More</a></p>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <h3 class="footer-heading mb-4 text-white">Quick Menu</h3>
                  <ul class="list-unstyled">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Approach</a></li>
                    <li><a href="#">Sustainability</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Careers</a></li>
                  </ul>
              </div>
              <div class="col-md-6">
                <h3 class="footer-heading mb-4 text-white">Categories</h3>
                  <ul class="list-unstyled">
                    <li><a href="#">Full Time</a></li>
                    <li><a href="#">Freelance</a></li>
                    <li><a href="#">Temporary</a></li>
                    <li><a href="#">Internship</a></li>
                  </ul>
              </div>
            </div>
          </div>

          
          <div class="col-md-2">
            <div class="col-md-12"><h3 class="footer-heading mb-4 text-white">Social Icons</h3></div>
              <div class="col-md-12">
                <p>
                  <a href="#" class="pb-2 pr-2 pl-0"><span class="icon-facebook"></span></a>
                  <a href="#" class="p-2"><span class="icon-twitter"></span></a>
                  <a href="#" class="p-2"><span class="icon-instagram"></span></a>
                  <a href="#" class="p-2"><span class="icon-vimeo"></span></a>

                </p>
              </div>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="icon-heart text-warning" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="{{asset('front_design/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('front_design/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('front_design/js/jquery-ui.js')}}"></script>
  <script src="{{asset('front_design/js/popper.min.js')}}"></script>
  <script src="{{asset('front_design/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('front_design/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('front_design/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('front_design/js/jquery.countdown.min.js')}}"></script>
  <script src="{{asset('front_design/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('front_design/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{asset('front_design/js/aos.js')}}"></script>

  
  <script src="{{asset('front_design/js/mediaelement-and-player.min.js')}}"></script>

  <script src="{{asset('front_design/js/main.js')}}"></script>
    

  <script>
      document.addEventListener('DOMContentLoaded', function() {
                var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

                for (var i = 0; i < total; i++) {
                    new MediaElementPlayer(mediaElements[i], {
                        pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                        shimScriptAccess: 'always',
                        success: function () {
                            var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                            for (var j = 0; j < targetTotal; j++) {
                                target[j].style.visibility = 'visible';
                            }
                  }
                });
                }
            });
    </script>



@stack('scripts')
  </body>
</html>