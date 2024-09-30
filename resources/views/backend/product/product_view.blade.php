@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Product List <span class="badge rounded-pill alert-success"> {{ count($products) }} </span></h2>
        <div>
            <a href="{{ route('product.add') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add Product</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Product Image</th> 
                            <th scope="col">Name (English)</th> 
                            <th scope="col">Name (Bangla)</th>
                            <th scope="col">Category</th>
                            <th scope="col">Product Price </th>
							<th scope="col">Quantity </th>
							<th scope="col">Discount </th>
							<th scope="col">Reseller Price </th>
                            <th scope="col">Featured</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($item->product_thumbnail) }}" class="img-sm" alt="Userpic" style="width: 80px; height: 70px;">
                                    </div>
                                </a>
                            </td>
                            <td> {{ $item->name_en ?? '' }} </td>
                            <td> {{ $item->name_bn ?? '' }} </td>
                            <td> {{ $item->category->name_en }} </td>
                            <td> {{ $item->regular_price ?? '' }} </td>
                            <td> 
                                @if($item->is_varient)
                                    Varient Product
                                @else
                                    {{ $item->stock_qty ?? '' }}
                                @endif
                            </td>
                            <td>
                            	@if($item->discount_price > 0)
                                    @if($item->discount_type == 1)
                                        <span class="badge rounded-pill alert-info">৳{{ $item->discount_price }} off</span>
                                    @elseif($item->discount_type == 2)
                                        <span class="badge rounded-pill alert-success">{{ $item->discount_price }}% off</span>
                                    @endif
                                @else
								 	<span class="badge rounded-pill alert-danger">No Discount</span>
								@endif
                            </td>
                            <td> {{ $item->reseller_price ?? '' }} </td>
                            <td>
                                @if($item->is_featured == 1)
                                  <a href="{{ route('product.featured',['id'=>$item->id]) }}">
                                    <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                  </a>
                                @else
                                  <a href="{{ route('product.featured',['id'=>$item->id]) }}" > <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 1)
                                  <a href="{{ route('product.in_active',['id'=>$item->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('product.active',['id'=>$item->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('product.edit',$item->id) }}">Edit info</a>
                                        <!-- <a class="dropdown-item" href="">View Details</a> -->
                                        @if(Auth::guard('admin')->user()->role == '2')
                                            <a class="dropdown-item text-danger" href="{{ route('product.delete',$item->id) }}" id="delete">Delete</a>
                                        @else
                                            @if(Auth::guard('admin')->user()->role == '1' || in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                <a class="dropdown-item text-danger" href="{{ route('product.delete',$item->id) }}" id="delete">Delete</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection