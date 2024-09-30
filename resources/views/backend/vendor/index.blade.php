@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Vendor list <span class="badge rounded-pill alert-success"> {{ count($vendors) }} </span></h2>
        <div>
            <a href="{{ route('vendor.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Vendor Create</a>
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
                            <th scope="col">Shop Profile</th> 
                            <th scope="col">Shop Name</th> 
                            <th scope="col">Vendor Name</th> 
                            <th scope="col">Email</th> 
                            <th scope="col">Phone</th> 
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $key => $vendor)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($vendor->shop_profile) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $vendor->shop_name ?? ' ' }} </td>
                            <td> {{ $vendor->vendor_name ?? ' ' }} </td>
                            <td> {{ $vendor->user->email ?? ' ' }} </td>
                            <td> {{ $vendor->user->phone ?? ' ' }} </td>
                            <td>
                                @if($vendor->status == 1)
                                  <a href="{{ route('vendor.in_active',['id'=>$vendor->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('vendor.active',['id'=>$vendor->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            
                            <td class="text-end">
                                <!--<a href="#" class="btn btn-md rounded font-sm">Detail</a>-->
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('vendor.edit',$vendor->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('vendor.delete',$vendor->id) }}" id="delete">Delete</a>
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