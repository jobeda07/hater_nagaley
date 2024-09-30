@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Withdraw History <span class="badge rounded-pill alert-success"></span></h2>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdraw_list as $data)
                            <tr>
                                <td>{{$data->method}}</td>
                                <td>{{$data->amount}}</td>
                                <td>
                                @if($data->status == 1)
                                    <a>
                                      <span class="badge rounded-pill alert-success">Paid</span>
                                    </a>
                                  @else
                                    <a> <span class="badge rounded-pill alert-danger">Unpaid</span></a>
                                  @endif
                                </td>

                                <td>{{$data->created_at->format('Y-m-d');}}</td>

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