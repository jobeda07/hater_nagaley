@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Reating & Review List <span class="badge rounded-pill alert-success"> {{ count($review) }} </span></h2>
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
                            <th scope="col">Product Name</th>
                            {{-- <th scope="col">Summary</th> --}}
                            <th scope="col">Reating</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($review as $key => $data)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $data->user->name ?? 'NULL' }} </td>
                            <td> {{ $data->product->name_en ?? 'NULL' }} </td>
                            {{-- <td> {{ $data->summary ?? 'NULL' }} </td> --}}
                            <td> {{ $data->rating ?? 'NULL' }} </td>
                            <td> {{ date('d-m-Y', strtotime($data->created_at)) }} </td>
                            <td>
                                @if($data->status == 1)
                                  <a href="{{ route('review.in_active',['id'=>$data->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('review.active',['id'=>$data->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('review.destroy', $data->id) }}" id="delete" class="btn btn-danger">Delete</a>
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
