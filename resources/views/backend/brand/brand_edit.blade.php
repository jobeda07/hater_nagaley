@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Brand Edit</h2>
        <div class="">
            <a href="{{ route('brand.all') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Brand List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name (English):</label>
                                    <input class="form-control" id="name_en" type="text" name="name_en" placeholder="Write brand name english" value="{{ $brand->name_en }}">
                                    @error('name_en')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                   <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name (Bangla):</label>
                                    <input class="form-control" id="name_bn" type="text" name="name_bn" placeholder="Write brand name bangla" value="{{ $brand->name_bn }}">
                                </div>
                                <div class="mb-4">
                                   <label for="description_en" class="col-form-label" style="font-weight: bold;">Description (English):</label>
                                    <textarea name="description_en" id="description_en" cols="5" placeholder="Write brand description english" class="form-control"> {{ $brand->description_en }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
                                    <textarea name="description_bn" id="description_bn" cols="5" placeholder="Write brand description english" class="form-control">{{ $brand->description_bn }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="col-form-label" style="font-weight: bold;">Cover Photo:</label>
                                    <input name="brand_image" class="form-control" type="file" id="image">
                                </div>
                                 <div class="mb-4">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ asset($brand->brand_image) }}" alt="Card image cap" width="100px" height="80px;">
                                </div>

                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $brand->status == 1 ? 'checked': '' }}>
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

@endsection