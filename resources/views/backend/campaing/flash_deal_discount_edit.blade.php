@if(count($product_ids) > 0)
<style type="text/css">
    table, tbody, tfoot, thead, tr, th, td{
        border: 1px solid #dee2e6 !important;
    }
    th{
        font-weight: bolder !important;
    }
</style>
<table class="table table-bordered table-responsive">
  <thead>
  	<tr>
  		<td width="15%">
          <span>Image</span>
  		</td>
      <td width="40%">
          <span>Product Name</span>
      </td>
      <td data-breakpoints="lg" width="20%">
          <span>Price</span>
  		</td>
  		<td data-breakpoints="lg" width="20%">
          <span>Discount</span>
  		</td>
      <td data-breakpoints="lg" width="10%">
          <span>Discount Type</span>
      </td>
  	</tr>
  </thead>
  <tbody>
      @foreach ($product_ids as $key => $id)
      @php
        $product = \App\Models\Product::findOrFail($id);
        $campaing_product = \App\Models\CampaingProduct::where('campaing_id', $campaing_id)->where('product_id', $product->id)->first();
      @endphp
      <tr>
          <td>
            <div class="from-group row">
              <div class="col-auto">
                <img class="size-60px img-fit" src="{{ asset($product->product_thumbnail)}}">
              </div>
            </div>
          </td>
          <td>
              <span>{{ $product->name_en ?? 'Null' }}</span>
          </td>
          <td>
              <span>{{ $product->regular_price ?? 'Null' }}</span>
          </td>
          <td>
            <input type="number" lang="en" name="discount_{{ $id }}" value="{{ $product->discount_price }}" min="0" step="1" class="form-control" required>
          </td>
          <td>
            <select class="form-control" name="discount_type_{{ $id }}">
                <option value="1" @if($product->discount_type == "1") selected @endif>Flat</option>
                <option value="2" @if($product->discount_type == "2") selected @endif>Percent %</option>
            </select>
          </td>
      </tr>
      @endforeach
  </tbody>
</table>
@endif

