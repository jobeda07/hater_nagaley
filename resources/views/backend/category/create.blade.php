@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Add Category</h2>
        <div class="">
            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Back To List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                           <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
			                	@csrf
			                    <div class="form-group row mb-4">
			                        <label class="col-md-3 col-form-label" for="name_en">Name English</label>
			                        <div class="col-md-9">
			                            <input type="text" placeholder="Name English" id="name_en" name="name_en" value="{{old('name_en')}}" class="form-control" >
										@error('name_en')
											<p class="text-danger">{{$message}}</p>
										@enderror
			                        </div>
			                    </div>
			                    <div class="form-group row mb-4">
			                        <label class="col-md-3 col-form-label" for="name_bn">Name Bangla</label>
			                        <div class="col-md-9">
			                            <input type="text" placeholder="Name Bangla" id="name_bn" name="name_bn" value="{{old('name_bn')}}" class="form-control" >
			                        </div>
			                    </div>
			                    <div class="form-group row mb-4">
			                    	<label for="parent_id" class="col-md-3 col-form-label" style="font-weight: bold;">Parent Category:</label>
				                    <div class="col-md-9">
						                <div class="custom_select">
		                                    <select class="form-control select-active w-100 form-select select-nice" name="parent_id" id="parent_id">
		                                    	<option value="0">No Parent</option>
				                                @foreach ($categories as $category)
				                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
				                                    @foreach ($category->childrenCategories as $childCategory)
				                                        @include('backend.include.child_category', ['child_category' => $childCategory])
				                                    @endforeach
				                                @endforeach
		                                    </select>
		                                </div>
			                        </div>
			                    </div>
			                    <!-- <div class="form-group row mb-4">
			                        <label class="col-md-3 col-form-label" for="type">
			                           Type
			                        </label>
			                        <div class="col-md-9">
			                            <input type="number" name="type" class="form-control" id="type" placeholder="Type Level">
			                            <small>Higher type has high priority</small>
			                        </div>
			                    </div> -->
			                    <div class="form-group row mb-4">
			                        <label class="col-md-3 col-form-label" for="description_en">Description English</label>
			                        <div class="col-md-9">
			                        	<textarea name="description_en" rows="5" class="form-control">{{old('description_en')}}</textarea>
			                        </div>
			                    </div>
			                    <div class="form-group row mb-4">
			                        <label class="col-md-3 col-form-label" for="description_bn">Description Bangla</label>
			                        <div class="col-md-9">
			                        	<textarea name="description_bn" rows="5" class="form-control">{{old('description_bn')}}</textarea>
			                        </div>
			                    </div>
			                    <div class="mb-4">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap" width="100px" height="80px;">
                                </div>
			                    <div class="mb-4">
                                    <label for="image" class="col-form-label" style="font-weight: bold;">Image:</label>
                                    <input name="image" class="form-control" type="file" id="image">
                                </div>
			                    <div class="mb-4">
                                    <div class="demo-checkbox">             
                                        <input type="checkbox" id="md_checkbox_29" class="form-check-input cursor" name="is_featured" value="1">
                                        <label for="md_checkbox_29" class="form-check-label cursor" style="font-weight: bold; padding-left: 8px;"> Is Features</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" checked value="1">
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>
			                    <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Submit">
									</div>
								</div>
			                </form>
                        </div>
                    </div>
                    <!-- .row // -->
                </div>
                <!-- card body .// -->
            </div>
            <!-- card .// -->
        </div>
    </div>
</section>

@endsection