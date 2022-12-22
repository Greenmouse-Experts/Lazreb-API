 <!--Haeder Nav-->
 <nav class="navbar navbar-expand-lg">
     <div class="container">
         <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
             <i class="fas fa-bars"></i>
         </button>
         <a class="navbar-brand" href="#">
             <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" alt="Lasreb logo">
         </a>
         <div class="login-div mobile-login">
             <a class="btn-login" href="{{ route('log')}}"><i class="bi bi-lock"></i> Login</a>
         </div>
         <div class="offcanvas offcanvas-start" tabindex="-100" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
             <div class="offcanvas-header">
                 <button data-bs-dismiss="offcanvas">
                     <i class="bi bi-x-square"></i>
                 </button>
             </div>
             <div class="offcanvas-body">
                 <ul class="navbar-nav justify-content-center flex-grow-1">
                     <li class="nav-item">
                         <a class="nav-link {{ (request()->is('index')) ? 'active' : '' }}" href="{{ route('index')}}">Home</a>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ (request()->is('about')) ? 'active' : '' }}" href="{{ route('about')}}">About Us</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ (request()->is('services')) ? 'active' : '' }}" href="{{ route('services')}}">Our Services</a>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ (request()->is('faqs')) ? 'active' : '' }}" href="{{ route('faqs')}}">FAQs</a>
                         </a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}" href="{{ route('contact')}}">Contact Us</a>
                         </a>
                     </li>
                 </ul>
                 <div class="login-div">
                     <a class="btn-login desktop-login" href="{{ route('log')}}"><i class="bi bi-lock"></i> Login</a>
                     <a class="btn-signup" href="{{ route('sign')}}">Sign Up <i class="bi bi-arrow-right"></i></a>
                 </div>
             </div>
         </div>
     </div>
 </nav>
 <!--Haeder Nav Ends-->