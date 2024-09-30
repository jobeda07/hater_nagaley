@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12 col-9">
            <div class="content-header">
                <h2 class="content-title">Attribute Add</h2>
                <div>
                    <a href="{{ route('attribute.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Attribute List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Attribute</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('attribute.store') }}" enctype="multipart/form-data">
                    	@csrf
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{old('name')}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
							<div class="col-4">
								<input type="submit" name="" class="btn btn-primary" value="Submit">
							</div>
						</div>
                    </form>
                </div>
            </div>
            <!-- card end// -->
        </div>
    </div>
</section>
@endsection