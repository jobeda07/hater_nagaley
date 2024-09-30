@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
		@isset($account_head)
			<h2 class="content-title">Edit Account Head</h2>
		@else
			<h2 class="content-title">Account Head Add</h2>
		@endisset
        <div class="">
            <a href="{{ route('page.index') }}" class="btn btn-primary"><i class="material-icons md-list"></i> Account Head List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('accounts.heads.store') }}" enctype="multipart/form-data">
		                    	@csrf
		                        <div class="mb-4">
		                           <label for="title" class="col-form-label" style="font-weight: bold;"> Title</label>
		                            <input class="form-control" id="title" type="text" name="title" placeholder="Write page name english" required="" value="{{old('title')}}">
		                            @error('title')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
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