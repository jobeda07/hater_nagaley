 <div class="sidebar-widget widget-category-2 mb-30">
    <h5 class="section-title style-1 mb-30">Tag</h5>
    <ul>
        @foreach($tags as $tag)
        <li>
            <a href="{{ url('tag-product/'.$tag->id.'/'.$tag->tag_slug_en) }}">
                <img src="#" alt="" />
                @if(session()->get('language') == 'bangla') 
                    {{ $tag->name_bn }}
                @else 
                    {{ $tag->name_en }} 
                @endif
            </a>
            @php
               $products = App\Models\Product::where('tag_id',$tag->id)->orderBy('id','DESC')->get(); 
            @endphp
            <span class="count">{{ count($products) }}</span>
        </li>
        @endforeach
    </ul>
</div>