@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Edit Profile</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
               @include('admin.body.asidebar')
                <div class="col-lg-9">
                    <section class="content-body p-xl-4">
                        <form method="post" action="{{ route('store.profile') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row gx-3">
                                        <div class="col-6 mb-3">
                                            <label class="form-label">First name</label>
                                            <input class="form-control" type="text" placeholder="Type here" value="{{ $editData->name }}" name="name" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" placeholder="example@mail.com" value="{{ $editData->email }}" name="email" />
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Phone</label>
                                            <input class="form-control" type="number" placeholder="+1234567890" name="phone" required="" value="{{ $editData->phone }}">
                                            <div class="invalid-feedback">
                                                Please Enter Your Number.
                                            </div>
                                        </div>
                                        <!-- col .// -->
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">Address</label>
                                            <input class="form-control" type="text" placeholder="Type here" name="address" value="{{ $editData->address }}" required="">
                                            <div class="invalid-feedback">
                                                Please Enter Your Address.
                                            </div>
                                        </div>
                                        <!-- col .// -->
                                    </div>
                                    <!-- row.// -->
                                </div>
                                <!-- col.// -->
                                <aside class="col-lg-4">
                                    <figure class="text-lg-center">
                                        <img id="showImage" class="img-lg mb-3 img-avatar" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="User Photo" />
                                        <input type="file" id="image" name="profile_image" required="">
                                        <div class="invalid-feedback">
                                            Please Enter Your Image.
                                        </div>
                                    </figure>
                                </aside>
                                <!-- col.// -->
                            </div>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </section>
                    <!-- content-body .// -->
                </div>
                <!-- col.// -->
            </div>
            <!-- row.// -->
        </div>
        <!-- card body end// -->
    </div>
    <!-- card end// -->
</section>

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
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
@endsection