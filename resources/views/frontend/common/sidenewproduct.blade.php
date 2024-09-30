<div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
    <h5 class="section-title style-1 mb-30">New products</h5>
    @forelse($new_products as $product)
    <div class="single-post clearfix">
        <div class="image">
            <img src="{{asset($product->product_thumbnail)}}" alt="#" />
        </div>
        <div class="content pt-10">
            <h5>
                <a href="{{ url('product-details/'.$product->id.'/'.$product->product_slug_en ) }}">
                    @if(session()->get('language') == 'bangla') 
                        {{ $product->name_bn }}
                    @else 
                        {{ $product->name_en }} 
                    @endif
                </a>
            </h5>
            <p class="price mb-0 mt-5">৳{{ $product->regular_price }}</p>
            <div class="product-rate">
                <div class="product-rating" style="width: 90%"></div>
            </div>
        </div>
    </div>
    @empty
        @if(session()->get('language') == 'bangla') 
            <h5 class="text-danger">এখানে কোন পণ্য খুঁজে পাওয়া যায়নি!</h5> 
        @else 
           <h5 class="text-danger">No products were found here!</h5> 
        @endif
    @endforelse
</div>