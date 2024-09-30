 <div class="sidebar-widget widget-category-2 mb-30">
    <h5 class="section-title style-1 mb-30">Category</h5>
    <ul>
        @foreach(get_categories() as $category)
        <li>
            <a href="{{ route('product.category', $category->slug) }}">
                <img src="{{ asset($category->image) }}" alt="" />
                @if(session()->get('language') == 'bangla') 
                    {{ $category->name_bn }}
                @else 
                    {{ $category->name_en }} 
                @endif
            </a>
            @php
               $products = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->get(); 
            @endphp
            <span>{{ count($products) }}</span>
        </li>
        @endforeach
    </ul>
</div>