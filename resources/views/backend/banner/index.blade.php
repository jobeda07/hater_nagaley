@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Banner list <span class="badge rounded-pill alert-success"> {{ count($banners) }} </span></h3>
        <div>
            <a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Banner Create</a>
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
                            <th scope="col">Banner Photo</th>
                            <th scope="col">Title (English)</th>
                            <th scope="col">Title (Bangla)</th>
                            <th scope="col">Position</th>
                            <th scope="col">Banner Url</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $key => $banner)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($banner->banner_img) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $banner->title_en ?? 'NULL' }} </td>
                            <td> {{ $banner->title_bn ?? 'NULL' }} </td>
                            @if($banner->position == 1)
                            <td> Home Banner </td>
                            @else
                            <td> Footer Banner </td>
                            @endif
                            <td> {{ $banner->banner_url ?? 'NULL' }} </td>
                            <td>
                                @if($banner->status == 1)
                                  <a href="{{ route('banner.in_active',['id'=>$banner->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('banner.active',['id'=>$banner->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('banner.edit', $banner->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('banner.delete',$banner->id) }}" id="delete">Delete</a>
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
