

<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('backend/js/ruang-admin.min.js')}}"></script>
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>  
  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script> --}}
  {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
  {{-- {!! Toastr::message() !!} --}}
  <script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
$(document).ready(function() {
  $('#summernote1').summernote();
});
  </script>
  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
  <script>
setTimeout(function()
{
   $("#alert").slideUp();
    }, 2000);

  </script>
  @yield('scripts')