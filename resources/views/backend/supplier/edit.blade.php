@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Suppliers Edit</h2>
        <div class="">
            <a href="{{ route('supplier.all') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>  Back To List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('supplier.update', $supplier->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                   <label for="name" class="col-form-label col-md-3" style="font-weight: bold;"> Supplier Name:</label>
                                    <input class="form-control" id="name" type="text" name="name" placeholder="Write Supplier Name" value="{{$supplier->name}}">
                                    @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                  <label for="phone" class="col-form-label col-md-3 " style="font-weight: bold;">Supplier Phone:</label>
                                    <input class="form-control" id="phone" type="number" name="phone" placeholder="Write Supplier Phone" value="{{$supplier->phone}}">
                                    @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                  <label for="email" class="col-form-label col-md-3 " style="font-weight: bold;">Supplier Email:</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Write Supplier Email" value="{{$supplier->email}}">
                                    @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="address" class="col-form-label col-md-3" style="font-weight: bold;">Supplier Address :</label>
                                    <textarea name="address" id="address" cols="5" class="form-control ">{{$supplier->address}}</textarea>
                                    @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $supplier->status == 1 ? 'checked': '' }}>
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