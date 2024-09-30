@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Supplier List <span class="badge rounded-pill alert-success"> {{ count($suppliers) }} </span></h2>
        <div>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Create Supplier</a>
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
                            <th scope="col">Phone</th> 
                            <th scope="col">Email</th> 
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->name ?? '' }} </td>
                            <td> {{ $item->phone ?? '' }} </td>
                            <td> {{ $item->email ?? '' }} </td>
                            <td> {{ $item->address ?? '' }} </td>
                            <td>
                                @if($item->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.in_active',['id'=>$item->id]) }}" @endif>
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('supplier.active',['id'=>$item->id]) }}" @endif> <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
                                    {{-- <a href="#" class="btn btn-md rounded font-sm">Detail</a> --}}
                                    <a class="btn btn-md rounded font-sm" href="{{ route('supplier.edit',$item->id) }}">Edit info</a>
                                    <a class="btn btn-md rounded font-sm bg-danger" href="{{ route('supplier.destroy',$item->id) }}" id="delete">Delete</a>
                                    {{-- <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('supplier.edit',$item->id) }}">Edit info</a>
                                            <a class="dropdown-item text-danger" href="{{ route('supplier.destroy',$item->id) }}" id="delete">Delete</a>
                                        </div>
                                    </div> --}}
                                    <!-- dropdown //end -->
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
</section>
@endsection
