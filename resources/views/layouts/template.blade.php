<!-- =========================================================
* Argon Dashboard PRO v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
* Copyright 2019 Creative Tim (https://www.creative-tim.com)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 -->
 <!DOCTYPE html>
 <html>
 
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
   <meta name="author" content="Creative Tim">
   <title>Internify | @stack('title')</title>
   <!-- Favicon -->
   <link rel="icon" href="{{ asset('new-assets/img/brand/favicon.png')}}" type="image/png">
   <!-- Fonts -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
   <!-- Icons -->
   <link rel="stylesheet" href="{{ asset('new-assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
   <link rel="stylesheet" href="{{ asset('new-assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
   <!-- Argon CSS -->
   <link rel="stylesheet" href="{{ asset('new-assets/css/argon.css?v=1.1.0')}}" type="text/css">
 </head>
 
 <body>
   <!-- Sidenav -->
   <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
     <div class="scrollbar-inner">
       <!-- Brand -->
       <div class="sidenav-header d-flex align-items-center">
         <a class="navbar-brand" href="#">
           <img src="{{ asset('new-assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
         </a>
         <div class="ml-auto">
         </div>
       </div>
       <div class="navbar-inner">
         <!-- Collapse -->
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
           <!-- Nav items -->
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="#navbar-manajemen" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-manajemen">
                 <i class="ni ni-shop text-primary"></i>
                 <span class="nav-link-text">Manajemen Magang</span>
               </a>
               <div class="collapse" id="navbar-manajemen">
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item">
                     <a href="#" class="nav-link">Akun Mahasiswa</a>
                   </li>
                   <li class="nav-item">
                     <a href="#" class="nav-link">Proposal Magang</a>
                   </li>
                   <li class="nav-item">
                     <a href="#" class="nav-link">Surat Balasan</a>
                   </li>
                   <li class="nav-item">
                     <a href="#" class="nav-link">Surat Pengantar</a>
                   </li>
                 </ul>
               </div>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#navbar-master" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-master">
                 <i class="ni ni-ungroup text-orange"></i>
                 <span class="nav-link-text">Master</span>
               </a>
               <div class="collapse" id="navbar-master">
                 <ul class="nav nav-sm flex-column">
                   <li class="nav-item">
                     <a href="#" class="nav-link">Dosen</a>
                   </li>
                   <li class="nav-item">
                     <a href="{{ route('tempat-magang.index') }}" class="nav-link">Tempat Magang</a>
                   </li>
                   <li class="nav-item">
                     <a href="{{ route('faq.index') }}" class="nav-link">FAQ</a>
                   </li>
                   <li class="nav-item">
                     <a href="#" class="nav-link">File Template</a>
                   </li>
                 </ul>
               </div>
             </li>
           </ul>
         </div>
       </div>
     </div>
   </nav>
   <!-- Main content -->
   <div class="main-content" id="panel">
     <!-- Topnav -->
     <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
       <div class="container-fluid d-flex justify-content-end align-items-right text-right">
        <div class="collapse navbar-collapse d-flex justify-content-end align-items-right text-right" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('new-assets/img/theme/team-4.jpg')}}">
                      </span>
                      <div class="media-body ml-2 d-none d-lg-block">
                        <span class="mb-0 text-sm  font-weight-bold">John Snow</span>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="dropdown-item">
                            <button button type="submit" class="border-0">
                                <i class="ni ni-user-run"></i>
                                Logout
                            </button>
                        </div>
                    </form>
                  </div>
                </li>
            </ul>
        </div>
       </div>
     </nav>
     <!-- Header -->
     <!-- Header -->
     <div class="header bg-primary pb-6">
       <div class="container-fluid">
         <div class="header-body">
           <div class="row align-items-center py-4">
             <div class="col-lg-6 col-7">
               <h6 class="h2 text-white d-inline-block mb-0">@stack('page-name')</h6>
               <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                    @yield('breadcrumb')
               </nav>
             </div>
             <div class="col-lg-6 col-5 text-right">
                @stack('add-button')
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- Page content -->
     <div class="container-fluid mt--6">
       <div class="card mb-4">
         <!-- Card header -->
         <div class="card-header">
           <h3 class="mb-0">@stack('card-header')</h3>
         </div>
         <!-- Card body -->
         <div class="card-body">
            @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong> {{ session('status') }}</strong>
                </div>
            @endif
      
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong> {{ session('error') }}</strong>
                </div>
            @endif
            @yield('content')
         </div>
         @yield('card-footer')
       </div>
       <!-- Footer -->
       <footer class="footer pt-0">
       </footer>
     </div>
   </div>
   <!-- Argon Scripts -->
   <!-- Core -->
   <script src="{{ asset('new-assets/vendor/jquery/dist/jquery.min.js')}}"></script>
   <script src="{{ asset('new-assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{ asset('new-assets/vendor/js-cookie/js.cookie.js')}}"></script>
   <script src="{{ asset('new-assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
   <script src="{{ asset('new-assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
   <!-- Argon JS -->
   <script src="{{ asset('new-assets/js/argon.js?v=1.1.0')}}"></script>
   <!-- Demo JS - remove this in your project -->
   <script src="{{ asset('new-assets/js/demo.min.js')}}"></script>

   @stack('custom-script')
 </body>
 
 </html>