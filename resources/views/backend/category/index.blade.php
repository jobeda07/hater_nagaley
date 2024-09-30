@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Category List <span class="badge rounded-pill alert-success"> {{ count($categories) }} </span></h2>
        <div>
            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i> Add Category</a>
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
                            <th scope="col">Image</th>
                            <th scope="col">Name (English)</th> 
                            <th scope="col">Name (Bangla)</th> 
                            <th scope="col">Type</th> 
                            <th scope="col">Parent</th>
                            <th scope="col">Status</th>
                            <th scope="col">Featured</th>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <th scope="col" class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $category)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($category->image) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
	                        <td> {{ $category->name_en ?? '' }} </td> 
	                        <td> {{ $category->name_bn ?? '' }} </td> 
	                        <td>
                             @if($category->type==1)
                                Parent Category
                             @elseif($category->type==2)
                                Sub Category
                             @elseif($category->type==3)
                                Sub Sub Category
                             @endif
                            </td> 
	                        <td> {{ $category->parent_name ?? '-' }} </td> 
                            <td>
                                @if($category->status == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.in_active',['id'=>$category->id]) }}" @endif>
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.active',['id'=>$category->id]) }}" @endif> <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td>
                                @if($category->is_featured == 1)
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}" @endif>
                                    <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                  </a>
                                @else
                                  <a @if(Auth::guard('admin')->user()->role != '2') href="{{ route('category.changeFeatureStatus',['id'=>$category->id]) }}" @endif> <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                @endif
                            </td>
                            @if(Auth::guard('admin')->user()->role != '2')
                                <td class="text-end">
                                    {{-- <a href="#" class="btn btn-md rounded font-sm">Detail</a> --}}
                                    <a class="btn btn-md rounded font-sm" href="{{ route('category.edit',$category->id) }}">Edit</a>
                                    <a class="btn btn-md rounded font-sm bg-danger" href="{{ route('category.delete',$category->id) }}" id="delete">Delete</a>

                                    {{-- <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('category.edit',$category->id) }}">Edit info</a>
                                            <a class="dropdown-item text-danger" href="{{ route('category.delete',$category->id) }}" id="delete">Delete</a>
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