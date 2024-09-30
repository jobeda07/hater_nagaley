@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Unit Edit</h2>
        <div class="">
            <a href="{{ route('unit.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Unit List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-6">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('unit.update',$unit->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                        <div class="mb-4">
		                           	<label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
		                            <input class="form-control" id="name" type="text" name="name" placeholder="Write unit name" value="{{$unit->name}}">
		                            @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $unit->status == 1 ? 'checked': '' }}>
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>
		                        
		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-6 col-md-4">
										<input type="submit" name="" class="btn btn-primary" value="Update">
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