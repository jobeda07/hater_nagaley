<a href="{{ route('compare') }}">
	<img class="svgInject" alt="estore-classic" src="{{asset('frontend/assets/imgs/theme/icons/icon-compare.svg')}}" />
	@if(Session::has('compare'))
		<span class="pro-count blue">{{ count(Session::get('compare'))}}</span>
	@else
		<span class="pro-count blue">0</span>
	@endif
</a>
<a href="{{ route('compare') }}"><span class="lable ml-0">Compare</span></a>