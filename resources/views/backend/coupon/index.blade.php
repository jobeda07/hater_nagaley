@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Coupon list <span class="badge rounded-pill alert-success"> {{ count($coupons) }} </span></h3>
        <div>
            <a href="{{ route('coupons.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Coupon Create</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Coupon Code</th> 
                            <th scope="col">Discount Type</th> 
                            <th scope="col">Charge</th> 
                            <th scope="col">User Limit</th>
                            <th scope="col">Total Limit</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $key => $coupon)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $coupon->coupon_code ?? 'NULL' }} </td>
                            @if($coupon->discount_type == 1)
                            <td> Fixed Amount </td>
                            @else
                            <td> Percent </td>
                            @endif
                            <td> {{ $coupon->discount ?? 'NULL' }} </td>
                            <td> {{ $coupon->limit_per_user ?? 'NULL' }} </td>
                            <td> {{ $coupon->total_use_limit ?? 'NULL' }} </td>
                            <td>
                                @if($coupon->status == 1)
                                  <a href="{{ route('coupon.in_active',['id'=>$coupon->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('coupon.active',['id'=>$coupon->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('coupons.edit',$coupon->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('coupon.delete',$coupon->id) }}" id="delete">Delete</a>
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