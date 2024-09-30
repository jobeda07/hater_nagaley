<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Dashboard</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />

        <!-- Favicon -->
        @php
            $logo = get_setting('site_favicon');
        @endphp
        @if($logo != null)
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? 'null') }}" />
        @else
            <link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" />
        @endif
        
        <!-- Template CSS -->
        <link href="{{ asset('backend/assets/css/main.css?v=1.1 ' ) }}" rel="stylesheet" type="text/css" />
        <!-- Custom CSS -->
        <link href="{{ asset('backend/assets/css/custom.css' ) }}" rel="stylesheet" type="text/css" />
        <!-- toastr css -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Color Picker -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">

        <!-- front awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        
        <!-- bootstrap tags input css -->
        <link href="{{ asset('backend/assets/bootstrap-tags/bootstrap-tagsinput.css ' ) }}" rel="stylesheet" type="text/css" />

        <!-- Datatable CSS -->
        <link rel="stylesheet" href=" https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

        <!-- Data Range CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <!-- summernote -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
        
        @stack('css')
        
        <style>
            div.dt-buttons {
                float: inherit !important;
            }
            div#example_info {
                position: absolute !important;
                bottom: 0 !important;
            }
        </style>
    </head>

    <body>
        <div class="screen-overlay"></div>
        <!-- ========== Header Section ========== -->
        @if(Auth::guard('admin')->user()->role == '2')
            @include('admin.body.vendor_sidebar')
        @else
            @include('admin.body.sidebar')
        @endif
        <main class="main-wrap">
            <!-- ========== Header Section ========== -->
            @include('admin.body.header')
           
            <!-- ========== Main Content Section ========== -->
            @yield('admin')
            <!-- content-main end// -->

            <!-- ========== Footer Section ========== -->
            @include('admin.body.footer')
            
        </main>


          <!-- Datatable Js -->
        <!--<script  src="{{ asset('backend/datatable/js/jquery-1.11.3.min.js ') }}"></script>-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

        <!-- <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js ') }}"></script> -->
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/select2.min.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/perfect-scrollbar.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js ') }}"></script>
        <script src="{{ asset('backend/assets/js/vendors/chart.js ') }}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=1.1 ') }}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/custom-chart.js ') }}" type="text/javascript"></script>

        <!-- toastr js -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- ColorPicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
        <script>
            $('#color').colorpicker();
        </script>

        <!-- bootstrap tags input js -->
        <script src="{{ asset('backend/assets/bootstrap-tags/bootstrap-tagsinput.min.js ') }}" type="text/javascript"></script>

        <!-- Data Range -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <!-- summernote start-->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        
    
        
        <script>
          $('.summernote').summernote({
            placeholder: 'Write Description',
            tabsize: 2,
            height: 120,
            minHeight: null,// set minimum height of editor
            maxHeight: null,// set maximum height of editor
            lang: true,
            focus: false,
            toolbar: [
              ['style', ['style']],
              ['fontname', ['fontname']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              // ['insert', ['link', 'picture', 'video']],
              // ['view', ['fullscreen', 'codeview', 'help']]
            ]
          });
        </script>
        <!-- summernote End-->

        <!-- all toastr message show  Update-->
        <script>
            @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break; 
            }
            @endif 
        </script>

        <!-- all toastr message show  old-->
        <script type="text/javascript">
            @if(Session::has('success'))
              toastr.success("{{Session::get('success')}}");
            @endif
            @if(Session::has('info'))
              toastr.info("{{Session::get('info')}}");
            @endif
            @if(Session::has('warning'))
              toastr.warning("{{Session::get('warning')}}");
            @endif
            @if(Session::has('error'))
              toastr.info("{{Session::get('error')}}");
            @endif
            @if(Session::has('danger'))
              toastr.danger("{{Session::get('danger')}}");
            @endif
        </script>

        <!-- sweetalert js--> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script type="text/javascript">
            $(function(){
                $(document).on('click','#delete',function(e){
                    e.preventDefault();
                    var link = $(this).attr("href");
        
                    Swal.fire({
                      title: 'Are you sure?',
                      text: "Delete This Data!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                })
      
              });
            });
        </script>

    <!-- Image Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "progressing": true,
                dom: 'Bfrtip',
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });
        });
    </script>

    @stack('footer-script')
    </body>
</html>