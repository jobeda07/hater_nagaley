@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>

<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Profit List</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table  class="table table-bordered table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>List</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Today Profit</td>
                                    <td>{{ $today_profit }}</td>
                                </tr>
                                <tr>
                                    <td>Monthly Profit</td>
                                    <td>{{ $monthly_profit }}</td>
                                </tr>
                                <tr>
                                    <td>Yearly Profit</td>
                                    <td>{{ $yearly_profit }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive //end -->
                </div>
                <!-- card-body end// -->
            </div>
            <!-- card end// -->
        </div>
    </div>
</section>
@endsection