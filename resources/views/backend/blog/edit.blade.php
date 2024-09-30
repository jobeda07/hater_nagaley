@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Blog Edit</h2>
        <div class="">
            <a href="{{route('blog.index') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Blog List</a>
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('blog.update',$blog->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                    	
		                        <div class="mb-4">
		                           <label for="title_en" class="col-form-label col-md-2" style="font-weight: bold;"> Title (English):</label>
		                            <input class="form-control" id="title_en" type="text" name="title_en" placeholder="Write blog title english" value="{{ $blog->title_en }}">'
		                            @error('title_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>

		                        <div class="mb-4">
		                          <label for="title_bn" class="col-form-label col-md-2" style="font-weight: bold;"> Title (Bangla):</label>
		                            <input class="form-control" id="title_bn" type="text" name="title_bn" placeholder="Write blog title bangla" value="{{ $blog->title_bn}}">
		                        </div>  

                               <div class="mb-4">
                                    <label for="image" class="col-form-label" style="font-weight: bold;">Blog Photo:</label>
                                    <input name="blog_img" class="form-control" type="file" id="image">
                                </div>
                                 <div class="mb-4">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ asset($blog->blog_img) }}" alt="Card image cap" width="100px" height="80px;">
                                </div>

                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $blog->status == 1 ? 'checked': '' }}>
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Update">
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
k

@endsection
