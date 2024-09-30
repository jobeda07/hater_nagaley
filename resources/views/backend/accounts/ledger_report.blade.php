@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Account Ledgers <span class="badge rounded-pill alert-success"> {{ count($account_ledgers) }} </span></h3>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive-sm">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Account Head</th> 
                            <th scope="col">Particulars</th> 
                            <th scope="col">Created At</th>
                            <th scope="col">
                                @if($account  == 'debit')
                                    Deposit
                                @else
                                    Expense
                                @endif
                            </th>
                            <th scope="col">Balance</th>
                        </tr>
                    </thead>
                    @php
                        $amount=0;
                        $sum1=0;
                        $sum2=0;
                    @endphp
                    <tbody>
                        @foreach($account_ledgers as $key => $ledger)
                        <tr>
                            <td> {{ $ledger->account_head->title ?? '' }} </td>
                            <td> {{ $ledger->particulars }} </td>
                            <td> {{ date_format(date_create($ledger->created_at),"Y/m/d" ) }} </td>
                            <td>
                                @if($account  == 'debit')
                                    {{ $ledger->credit }}
                                @else
                                    {{ $ledger->debit }}
                                @endif
                            </td>
                            <td> {{ $ledger->balance }} </td>
                        </tr> 
                        @php
                          $amount+=$ledger->credit;
                          $sum1+=$ledger->debit;
                          $sum2+=$ledger->credit - $ledger->debit;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                @if($account  == 'debit')
                                    Sum : {{ $amount }}
                                @else
                                    Sum : {{ $sum1 }}
                                @endif
                            </td>
                            <td>Balance: {{ $sum2 }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection
@push('footer-script')


    <script>
        $(document).ready(function(){
            $(document).on('click', '.viweBtn', function(){
                var p_name = $(this).closest('tr').find('.p_name').text();
                // alert(p_name);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        'checking_view': true,
                        'p_name': p_name,
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush