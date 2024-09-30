@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
		@isset($account_head)
			<h2 class="content-title">Edit Account Ledger</h2>
		@else
			<h2 class="content-title">Account Ledger Add</h2>
		@endisset
        <div class="">
            <a href="{{ route('page.index') }}" class="btn btn-primary"><i class="material-icons md-list"></i> Account Ledger List</a>
        </div>
    </div> 
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="post" action="{{ route('accounts.ledgers.store') }}" enctype="multipart/form-data">
		                    	@csrf
								<div class="custom_select">
		                           <label for="head_id" class="col-form-label" style="font-weight: bold;"> Account Head</label>
		                            <select name="head_id" id="head_id" class="form-control select-active w-100 form-select select-nice">
										<option value="">-- Select Account Head --</option>
										@foreach($account_heads as $account_head)
											<option value="{{ $account_head->id }}">{{ $account_head->title }}</option>
										@endforeach
									</select>
		                            @error('head_id')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
								<div class="custom_select">
		                           <label for="type_id" class="col-form-label" style="font-weight: bold;"> Account Head</label>
		                            <select name="type_id" id="type_id" class="form-control select-active w-100 form-select select-nice">
										<option value="">-- Select Transaction Type --</option>
										<option value="1">Expense</option>
										<option value="2">Deposit</option>
									</select>
		                            @error('type_id')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4">
		                           <label for="amount" class="col-form-label" style="font-weight: bold;"> Amount</label>
		                            <input class="form-control" id="amount" type="text" name="amount" placeholder="Write page name english" required="" value="{{old('amount')}}">
		                            @error('amount')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
								<div class="mb-4">
		                           <label for="particulars" class="col-form-label" style="font-weight: bold;"> Particulars</label>
		                            <input class="form-control" id="particulars" type="text" name="particulars" placeholder="Write page name english" required="" value="{{old('particulars')}}">
		                            @error('particulars')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        
		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Submit">
									</div>
								</div>
		                    </form>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>

@endsection