<!DOCTYPE html>
<html lang="en">

<head>
  @include('backend.layouts.head')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    @include('backend.layouts.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       @include('backend.layouts.nav')
        <!-- Topbar -->

        <!-- Container Fluid-->
       @yield('content')
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="#" target="_blank">Kapil Verma</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
    </div>
    
    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>
    @include('backend.layouts.footer')
</body>

</html>