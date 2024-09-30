@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Account Ledgers <span class="badge rounded-pill alert-success"> {{ count($account_ledgers) }} </span></h3>
        <div>
            <a href="{{ route('accounts.ledgers.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add New</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('accounts.leagers.report') }}" method="post">
                @csrf
                <div class="row align-items-center mb-4" style="padding-top:15px">
                    <div class="col-sm-3 col-5">
                        <div class="form-group">
                           <label for="account" class="col-form-label">Account:</label>
							<div class="custom_select">
								<select class="form-control select-active w-100 form-select select-nice" name="account" id="account">
									<option {{old('account') ? '' : 'selected'}} value="debit">Deposit</option>
									<option {{old('account') ? '' : 'selected'}} value="credit">Expense</option>
								</select>
							</div>
                        </div>
                    </div>
                      <div class="col-sm-3 col-5">
                        <div class="form-group">
                            <?php $date = date('Y-m-d'); ?>
                           <label for="start_date" class="col-form-label">Start Date</label>
                           <input type="date" class="form-control" name="start_date" value="{{ $date }}" required="" />
                        </div>
                      </div>
                    <div class="col-sm-3 col-4">
                      <div class="form-group">
                        <label for="end_date" class="col-form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $date }}" required="" />
                      </div>
                    </div>
                    <div class="col-sm- col-3" style="margin-top: 32px;">
                      <div class="form-group">
                        <!--<input type="submit" class="btn btn-info" value="Search">-->
                        <button class="btn btn-primary" type="submit">Filter</button>
                      </div>
                    </div>
                </div>
            </form>
                    
            <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Account Head</th> 
                            <th scope="col">Particulars</th> 
                            <th scope="col">Created At</th>
                            <th scope="col">Deposit</th>
                            <th scope="col">Expense</th>
                            <th scope="col">Balance</th>
                            <th scope="col" class="text-end">Action</th>
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
                            <td> {{ $ledger->account_head->title }} </td>
                            <td> {{ $ledger->particulars }} </td>
                            <td> {{ date_format(date_create($ledger->created_at),"Y/m/d" ) }} </td>
                            <td> {{ $ledger->credit }} </td>
                            <td> {{ $ledger->debit }} </td>
                            <td> {{ $ledger->balance }} </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('52', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                            <a class="dropdown-item text-danger" href="{{ route('accounts.ledgers.delete',$ledger->id) }}" id="delete">Delete</a>
                                        @endif
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
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
                            <td></td><td></td><td></td>
                            <td>Sum : {{ $amount }}</td>
                            <td>Sum : {{ $sum1 }}</td>
                            <td >Balance : {{ $sum2 }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
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
@endsection