<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title') | Warung Laundry</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/materialize.min.css')}}"  media="screen,projection"/>

    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/style.css')}}"/>

    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/load.css')}}"/>


    <link href="{{URL::asset('css/inconsolata.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('css/material-icon.css')}}" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section"></div>
     
    </div>

    <div class="parallax-container">
      <div class="parallax">
        <img src="{{URL::asset('fasilkom.png')}}">  
      </div>
    </div>

    <div class="menu">
      @if(Auth::user() && Auth::user()->name != "guest")
      <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{url('/edit-profile')}}" class="waves-effect waves-light">Edit Profile</a></li>
        <li><a href="{{url('/mentee')}}" class="waves-effect waves-light">Mentee</a></li>
        <li><a href="{{url('/absensi')}}" class="waves-effect waves-light">Absensi</a></li>
        <li><a href="{{url('/library')}}" class="waves-effect waves-light">Library</a></li>
      </ul>
      @endif
      <nav>
        <div class="nav-wrapper wrap">
          <a href="{{url('/')}}" class="brand-logo left">API Warung Laundry</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="{{url('/')}}" class="waves-effect waves-light">Home</a></li>
            @if(!\SSO\SSO::check())
             <li><a href="{{url('/login')}}" class="waves-effect waves-light">Login</a></li>
            @endif
            @if(SSO\SSO::check())
              <?php \SSO\SSO::authenticate(); $sso = \SSO\SSO::getUser(); ?>
              <li><a href="{{url('/docs/logout')}}" class="waves-effect waves-light">Logout ({{$sso->username}})</a></li>
            @endif
            <li style="height:64px">
              <form action="{{url('/search')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-field searchbar" style="width:50px;">
                  <input id="search" name="key" type="search" required>
                  <label for="search"><i class="material-icons">search</i></label>
                </div>
              </form>

            </li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li><a href="{{url('/')}}" class="waves-effect waves-light">Home</a></li>
            @if(!Auth::user())
             <li><a href="{{url('/login')}}" class="waves-effect waves-light">Login</a></li>
            @endif
            @if(Auth::user())
              <?php \SSO\SSO::authenticate(); $sso = \SSO\SSO::getUser(); ?>
              <li><a href="{{url('/logout')}}" class="waves-effect waves-light">Logout ({{$sso->username}})</a></li>
            @endif
          </ul>

        </div>
      </nav>
    </div>

    <div class="wrap">

      @yield('content')

    </div>

    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Tentang Warung Laundry</h5>
            <p class="grey-text text-lighten-4">Proyek ini dibuat untuk memudahkan pengguna aplikasi dalam mencuci baju dan memudahkan para pemilik bisnis laundry untuk memasarkan jasa mereka.</p>
          </div>
          <div class="col l4 offset-l2 s12">
            <!-- gambar -->
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        Crafted with love by <a href="http://twitter.com/wiradh" title="wiradh">@wiradh</a>
        <a class="grey-text text-lighten-4 right" href="#!">&copy; PPLB08 2016</a>
        </div>
      </div>
    </footer>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/materialize.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/scrollreveal.min.js')}}"></script>

    <script>
      $(document).ready(function(){
        $(".dropdown-button").dropdown();
        $('.parallax').parallax();
        $(".button-collapse").sideNav();
        $('.slider').slider({full_width: true});
        $('.indicators').attr("style", "margin-top:20px;");

        $(".searchbar").click(function(){
          $(this).animate({width: '300px'}, 250);
        });
        $("#search").focusout(function(){
          $(".searchbar").animate({width: '50px'}, 250);
        });

        setTimeout(function(){
          $('body').addClass('loaded');
          $('h1').css('color','#222222');
          $('#loader-wrapper').fadeOut();
        }, 3000);

        var num = 200; //number of pixels before modifying styles

        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > num) {
                $('nav').addClass('atas');
                $('.menu').addClass('navbar-fixed');
            } else {
                $('nav').removeClass('atas');
                $('.menu').removeClass('navbar-fixed');
            }
        });
      });

      window.scrollReveal = new scrollReveal({reset :true, mobile:true});
    </script>

    @yield('script')
    
  </body>
</html>