@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Reseller Details</h2>
            {{-- <div>
            <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i> Create Reseller</a>
        </div> --}}
        </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="" class="table table-bordered table-striped" width="100%">
                        <tbody>
                            <tr>
                                <td> Name: </td>
                                <td> {{ $reseller->name ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Username: </td>
                                <td> {{ $reseller->username ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Phone: </td>
                                <td> {{ $reseller->phone ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Email: </td>
                                <td> {{ $reseller->email ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Address: </td>
                                <td> {{ $reseller->address ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Wallet Balance: </td>
                                <td> {{ $reseller->wallet_balance ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Default Wallet Amount: </td>
                                <td> {{ $reseller->wallet_default_amount ?? '' }} </td>
                            </tr>
                            <tr>
                                <td> Status: </td>
                                <td>
                                    @if ($reseller->status == 1)
                                        <a href="{{ route('reseller.changeStatus', ['id' => $reseller->id]) }}">
                                            <span class="badge rounded-pill alert-success">Active</span>
                                        </a>
                                    @else
                                        <a href="{{ route('reseller.changeStatus', ['id' => $reseller->id]) }}"> <span
                                                class="badge rounded-pill alert-danger">Inactive</span></a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td> Approval: </td>
                                <td>
                                    @if ($reseller->is_approved == 1)
                                        <span class="badge rounded-pill alert-success">Approved</span>
                                    @else
                                        <a href="{{ route('reseller.approve', ['id' => $reseller->id]) }}"
                                            class="btn btn-md rounded font-sm">
                                            <span class="badge rounded-pill alert-success">Approve</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>
@endsection
