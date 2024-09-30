@extends('admin.admin_master')
@push('css')
<style type="text/css">
    .content-main {
        min-height: 50px !important;
    }
    .table-content {
        min-height: calc(100vh - 110px) !important;
    }
</style>
@endpush
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-12 col-9">
            <div class="content-header">
                <h2 class="content-title">Attribute Show</h2>
                <div>
                    <a href="{{ route('attribute.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left mt-0"></i> Attribute List</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Attribute Edit</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('attribute.update',$attribute->id) }}" enctype="multipart/form-data">
                    	@csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{$attribute->name}}">
                            @else
                                <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" readonly value="{{$attribute->name}}">
                            @endif
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-end">
							<div class="col-sm-4 col-12">
								<input type="submit" name="" class="btn btn-primary" value="Update">
							</div>
						</div>
                    </form>
                </div>
            </div>
            <!-- card end// -->
        </div>
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Value Create</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('attribute.value_store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">

                        <div class="mb-4">
                            <label for="value" class="col-form-label" style="font-weight: bold;"> Value:</label>
                            <input class="form-control" id="value" type="text" name="value" placeholder="Write attribute value" value="{{old('value')}}">
                            @error('value')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
                            <div class="col-12 col-sm-3 col-md-6 me-0 me-sm-4 me-lg-0">
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
<section>
    <div class="content-main">
        <div class="row">
            <div class="col-md-12 col-9">
                <div class="content-header mb-0">
                    <h2 class="content-title">Attribute Value List</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content-main table-content">
    <div class="card mb-4 col-12 mx-auto">
        <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive-sm">
                <table  class="table table-bordered table-striped" id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Value</th> 
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $key => $value)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $value->value ?? 'NULL' }} </td>
                            <td>
                                @if($value->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('attribute_value.in_active',$value->id) }}" @endif>
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                    <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('attribute_value.active',$value->id) }}" @endif>
                                        <span class="badge rounded-pill alert-danger">Disable</span>
                                    </a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
                                    {{-- <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="#" data-bs-toggle="modal" data-bs-target="#value{{ $value->id }}">Edit</a> --}}
                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('attribute_value.edit',$value->id) }}">Edit</a>
                                    <a class="btn btn-primary btn-icon btn-circle btn-sm btn-xs" href="{{ route('attribute_value.delete',$value->id) }}" id="delete">Delete</a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
    <!-- card end// -->
</section>

@if(count($values) > 0)
    <!--  Attribute Modal -->
    <div class="modal fade attribute" id="value{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-header">
                <h3>Attribute Edit</h3>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{ $value->id }}">
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
    </div>
@endif
@endsection