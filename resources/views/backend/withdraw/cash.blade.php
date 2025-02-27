@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Payment Withdraw (Cash)<span class="badge rounded-pill alert-success"></span></h2>
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
                            <th scope="col">Purpose</th>
                            <th scope="col">Ammount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cash as $key => $data)
                           <tr>
                                <td scope="col">{{$key+1}}</td>
                                <td scope="col">{{$data->name}}</td>
                                <td scope="col">{{$data->purpose}}</td>
                                <td scope="col">{{$data->amount}}</td>
                                <td>
                                    @if($data->status == 1)
                                      <a>
                                        <span class="badge rounded-pill alert-success">Paid</span>
                                      </a>
                                    @else
                                      <a href="{{route('withdraw.status', $data->id)}}"> <span class="badge rounded-pill alert-danger">Unpaid</span></a>
                                    @endif
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