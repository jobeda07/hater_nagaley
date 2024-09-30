@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Campaign list <span class="badge rounded-pill alert-success"> {{ count($campaings) }} </span></h3>
        <div>
            <a href="{{ route('campaing.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Campaign Create</a>
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
                            <th scope="col">Campaign Photo</th> 
                            <th scope="col">Name (English)</th> 
                            <th scope="col">Name (Bangla)</th> 
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($campaings as $key => $campaing)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td width="15%">
                                <a href="#" class="itemside">
                                    <div class="left">
                                        <img src="{{ asset($campaing->campaing_image) }}" class="img-sm img-avatar" alt="Userpic" />
                                    </div>
                                </a>
                            </td>
                            <td> {{ $campaing->name_en ?? 'NULL' }} </td>
                            <td> {{ $campaing->name_bn ?? 'NULL' }} </td>
                            <td>
                                @if($campaing->status == 1)
                                  <a href="{{ route('campaing.in_active',['id'=>$campaing->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('campaing.active',['id'=>$campaing->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('campaing.edit',$campaing->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('campaing.delete',$campaing->id) }}" id="delete">Delete</a>
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