@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Unit list <span class="badge rounded-pill alert-success"> {{ count($units) }} </span></h3>
        <div>
            <a href="{{ route('unit.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Unit Create</a>
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
                            <th scope="col">Unit Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $key => $unit)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $unit->name ?? '' }} </td>
                            <td>
                                @if($unit->status == 1)
                                  <a href="{{ route('unit.changeStatus',['id'=>$unit->id]) }}">
                                    <span class="badge rounded-pill alert-success"><i class="material-icons md-check"></i></span>
                                  </a>
                                @else
                                  <a href="{{ route('unit.changeStatus',['id'=>$unit->id]) }}" > <span class="badge rounded-pill alert-danger"><i class="material-icons md-close"></i></span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                {{-- <a href="#" class="btn btn-md rounded font-sm">Detail</a> --}}
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('unit.edit', $unit->id) }}">Edit info</a>
                                        <a class="dropdown-item text-danger" href="{{ route('unit.delete',$unit->id) }}" id="delete">Delete</a>
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
