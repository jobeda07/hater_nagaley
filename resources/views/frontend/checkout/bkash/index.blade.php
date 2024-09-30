@extends('layouts.frontend')

@section('content-frontend')

  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="card mt-4">
        <div class="card-body">
          <h1 class="text-center font-weight-bold" style="font-size: 20px">Order Invoice # <span class="text-danger">{{ session()->get('invoice_no') }}</span></h1>
          <h1 class="text-center mt-3">Amount to be paid: <span class="text-danger">BDT {{ session()->get('payment_amount') }}</span></h1>
          <h1 class="text-center mt-1">Payment Method: <span class="text-danger">bKash Online</span></h1>
          <h1 class="text-center mt-3"><a class="btn btn-primary" href="{{ URL::previous() }}">Back</a></h1>
        </div>
      </div>
    </div>
  </div>
  
  <form action="{{ route('bkash.checkout') }}" method="POST">
      @csrf
      <button type="submit" id="bKash_button" class="d-none">Pay With bKash</button>
  </form>

@endsection

@push('footer-script')
<script type="text/javascript">
  $(document).ready(function(){
      $('#bKash_button').trigger('click');
  });
</script>
@endpush