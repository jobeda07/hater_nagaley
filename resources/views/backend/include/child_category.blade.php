@php
    $value = null;
    for ($i=0; $i < $child_category->type; $i++){
        $value .= '--';
    }
@endphp
<option value="{{ $child_category->id }}" @if($child_category->id==$category->parent_id) selected  @endif>{{ $value." ".$child_category->name_en }}</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('backend.include.child_category', ['child_category' => $childCategory])
    @endforeach
@endif
