<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://warehouse-admin-dashboard.multipurposethemes.com/images/favicon.ico">

    <title>{{ config('app.name', 'Laravel') }}</title>
  
    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- toastr css--> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors_css.css ' )}}">
      
    <!-- Style-->  
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css ')}}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/skin_color.css ')}}">   
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url({{ asset('backend/images/auth-bg/bg-1.jpg ' ) }})">
    
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">                      
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h3 class="mb-0 text-primary">Recover Password</h3>                             
                            </div>
                            <div class="p-40">
                                <form action="{{ route('password.email') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                            <input type="email" class="form-control ps-15 bg-transparent" placeholder="Your Email" name="email" required="">
                                        </div>
                                    </div>
                                      <div class="row">
                                        <div class="col-12 text-center">
                                          <button type="submit" class="btn  btn-info btn-block margin-top-10">Reset</button>
                                        </div>
                                        <!-- /.col -->
                                      </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  



    
    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/js/vendors.min.js ') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/chat-popup.js ') }}"></script>
    <script src="{{ asset('backend/assets/icons/feather-icons/feather.min.js ' ) }}"></script>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</body>

<!-- Mirrored from warehouse-admin-dashboard.multipurposethemes.com/main/auth_user_pass.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Jul 2022 16:49:40 GMT -->
</html>
