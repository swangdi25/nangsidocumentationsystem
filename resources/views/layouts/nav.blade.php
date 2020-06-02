
<nav class="navbar navbar-light bg-inverse" style="background-color:orange">
    <div class="container d-flex justify-content-betIen">
   @guest
   @else
     <button id="sidebarCollapse" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" 
       aria-controls="navbarHeader" aria-expanded="true" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
   @endguest      
       </button>
       <embed src="{{ asset('cropped-rgob-logo-copy.png') }}" id="img" width="50px" height="50px">
       <h4>Nangsi Documentation System (NDS)</h4>

      <span><!-- Search form -->
      <!--  <form class="form-inline active-cyan-3 active-cyan-4">
          
          <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
            aria-label="Search">
            <i class="fas fa-search" aria-hidden="true"></i>
        </form> -->
      </span>
      <span> <!-- login -->
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
        
        <div class="container-wrapper" >
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent ">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
              
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        </nav>
       </span>
      <!-- login -->
     <!-- <span>
        <a href="#"><i class="fas fa-user-plus"></i>&nbsp;Sign Up</a> &nbsp;&nbsp;
        <a href="#"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
      </span> -->

      
    </div>

 </nav>

 
