@extends('admin.admin_master')
@section('admin')
<style type="text/css">
	.checkbox_custom .form-switch .form-check-input {
	    width: 4em;
	    margin-left: -1.5em;
	    border-radius: 2em;
	}
	.checkbox_custom .form-check-input {
	    width: 1em;
	    height: 2em;
	    margin-top: 1.25em;
	    margin-bottom: 1.25em;
	    cursor: pointer
	}
</style>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Role Information</h2>
        <div class="">
            <a href="{{route('roles.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Role List</a>
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-12">
    		<div class="card">
    			<div class="card-header">
    				<h5 class="text-white">Role Information</h5>
    			</div>
    			<form action="{{ route('roles.store') }}" method="POST">
    				@csrf
			        <div class="card-body">
			        	<div class="form-group row">
		                    <label class="col-md-3 col-from-label" for="name">Name</label>
		                    <div class="col-md-9">
		                        <input type="text" placeholder="Name" id="name" name="name" class="form-control" required>
		                    </div>
		                </div>
		                <div class="mt-3">
		                	<h5 class="">Permissions</h5>
		                </div>
		                <hr>
		                <div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Product</li>
						      <li class="list-group-item">
						         <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">Add New product
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="1"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Show All Products
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="2"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Products Edit
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="3"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Products Delete
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="4"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						         </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Product category</li>
						      <li class="list-group-item">
						         <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View Product Categories
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="5"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Product Category
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="6"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Product Category
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="7"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Product Category
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="8"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						         </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Product Brand</li>
						      <li class="list-group-item">
						         <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Brands
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="9"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Brand
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="10"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Brand
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="11"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Brand
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="12"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						         </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Product Attribute</li>
						      <li class="list-group-item">
						         <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View Product Attributes
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="13"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Product Attribute
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="14"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Product Attribute
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="15"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Product Attribute
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="16"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						         </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
							<ul class="list-group">
							   <li class="list-group-item bg-light" aria-current="true">Unit Type</li>
							   <li class="list-group-item">
								  <div class="row">
									 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="p-2 border mt-1 mb-4 checkbox_custom">
										 <label class="control-label" id="flexSwitch1">View Unit
											   <div class="form-check form-switch">
												   <input class="form-check-input" name="permissions[]" value="53"  type="checkbox" id="flexSwitch1">
											   </div>
										 </label>
										</div>
									 </div>
									 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="p-2 border mt-1 mb-4 checkbox_custom">
												<label class="control-label" id="flexSwitch2">Add Unit
												   <div class="form-check form-switch">
													   <input class="form-check-input" name="permissions[]" value="54"  type="checkbox" id="flexSwitch2">
												   </div>
											 	</label>
										</div>
									 </div>
									 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										 <div class="p-2 border mt-1 mb-4 checkbox_custom">
												<label class="control-label" id="flexSwitch2">Edit Unit
												   <div class="form-check form-switch">
													   <input class="form-check-input" name="permissions[]" value="55"  type="checkbox" id="flexSwitch2">
												   </div>
											 </label>
										 </div>
									 </div>
									 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										 <div class="p-2 border mt-1 mb-4 checkbox_custom">
												<label class="control-label" id="flexSwitch2">Delete Unit
												   <div class="form-check form-switch">
													   <input class="form-check-input" name="permissions[]" value="56"  type="checkbox" id="flexSwitch2">
												   </div>
											 </label>
										 </div>
									 </div>
								  </div>
							   </li>
							</ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Sale</li>
						      <li class="list-group-item">
						         <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Orders
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="17"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">View Order Details
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="18"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Update Order Payment Status
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="19"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Order
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="20"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						         </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Blog</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View Blogs
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="21"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Blog
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="22"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Blog
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="23"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Blog
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="24"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Staff</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Staffs
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="25"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Staff
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="26"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Staff
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="27"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Staff
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="28"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">View Staff Roles
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="29"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Staff Role
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="30"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Staff Role
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="31"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Staff Role
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="32"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">OTP System</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">OTP Configurations
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="33"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">SMS Templates
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="34"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Sms Providers Configurations
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="35"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Send Bulk SMS
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="36"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Slider</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Slider
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="37"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Slider
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="38"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Slider
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="39"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Slider
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="40"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Campaing</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Campaing
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="41"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Campaing
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="42"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Campaing
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="43"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Campaing
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="44"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Suppliers</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Supplier
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="45"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Supplier
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="46"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Supplier
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="47"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Supplier
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="48"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div><br>
						<div class="bd-example">
						   <ul class="list-group">
						      <li class="list-group-item bg-light" aria-current="true">Pages</li>
						      <li class="list-group-item">
						        <div class="row">
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
						                <label class="control-label" id="flexSwitch1">View All Page
						                  	<div class="form-check form-switch">
						                  		<input class="form-check-input" name="permissions[]" value="49"  type="checkbox" id="flexSwitch1">
						                  	</div>
										</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						               <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Add Page
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="50"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						               </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Edit Page
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="51"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
						                <div class="p-2 border mt-1 mb-4 checkbox_custom">
							               	<label class="control-label" id="flexSwitch2">Delete Page
							                  	<div class="form-check form-switch">
							                  		<input class="form-check-input" name="permissions[]" value="52"  type="checkbox" id="flexSwitch2">
							                  	</div>
											</label>
						                </div>
						            </div>
						        </div>
						      </li>
						   </ul>
						</div>
						<div class="row mb-4 mt-3 justify-content-sm-end">
							<div class="col-lg-2 col-md-4 col-sm-5 col-6">
								<input type="submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
			        </div>
			        <!-- card body .// -->
			    </form>   
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>
k

@endsection
