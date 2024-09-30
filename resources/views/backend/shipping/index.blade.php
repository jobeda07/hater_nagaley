@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Shipping list <span class="badge rounded-pill alert-success"> {{ count($shippings) }} </span></h3>
        <div>
            <a href="{{ route('shipping.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Shipping Create</a>
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
                            <th scope="col">Name</th> 
                            <th scope="col">Type</th> 
                            <th scope="col">Shipping Charge</th> 
                            <th scope="col">Shipping Time</th> 
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shippings as $key => $shipping)
                        <tr>
                            <td> {{ $key+1}} </td>
                           
                            <td> {{ $shipping->name ?? ' ' }} </td>
                            <td>
                                @if($shipping->type == 1)
                                    Inside Dhaka
                                @else($shipping->type == 2)
                                    Outside Dhaka
                                @endif
                            </td>
                            <td> {{ $shipping->shipping_charge ?? ' ' }} </td>
                            <td> {{ $shipping->time ?? ' ' }} </td>
                            <td>
                                @if($shipping->status == 1)
                                  <a href="{{ route('shipping.in_active',['id'=>$shipping->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('shipping.active',['id'=>$shipping->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('shipping.edit', $shipping->id)}}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('shipping.delete', $shipping->id)}}" id="delete">Delete</a>
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