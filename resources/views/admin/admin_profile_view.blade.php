@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Profile setting</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
                @include('admin.body.asidebar')
                <div class="col-lg-9">
                    <section class="content-body ">
                        <div class="row justify-content-center">
							<div class="col-12 col-lg-12">
							   <div class="box box-widget widget-user">
							      <!-- Add the bg color to the header using any of the bg-* classes -->
							      <div class="widget-user-header bg-img bbsr-0 bber-0"  style=" height: 150px; background-image: url({{ asset('backend/images/2.jpg') }}) " data-overlay="5">
							      </div>
							      <div class="widget-user-image" style="    position: absolute; top: 128px; left: 50%;margin-left: 58px;">
							        <img class="" style="width: 100px; height: 100px; border-radius: 50%;" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="User Avatar">
							      </div>
							      <div class="box-footer">
							        <div class="row mt-3">
							        	<div class="col-12">
							               <div class="">
								               	<p>Name : <span class="text-gray ps-10">{{ $adminData->name ?? 'NULL' }}</span> </p>
								                <p>Email : <span class="text-gray ps-10">{{ $adminData->email ?? 'NULL' }}</span> </p>
								                <p>Phone : <span class="text-gray ps-10">{{ $adminData->phone ?? 'NULL' }}</span></p>
								                <p>Address : <span class="text-gray ps-10">{{ $adminData->address ?? 'NULL' }}</span></p>
							               </div>
							           </div>
							          	<div class="col-12 mt-3">
											<div>
												<div class="map-box">
													<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233667.8223924372!2d90.27923775747219!3d23.780887456211758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1658065603227!5m2!1sen!2sbd" width="660" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
												</div>
											</div>
										</div>
							        </div>
							      </div>
							   </div>
							</div>
						</div>
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
@endsection