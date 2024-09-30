<div class="mb-4">
	@foreach ($attributes as $attribute)
	<div class="custom_select cit-multi-select mb-4">
		<label for="choice_attributes" class="col-form-label" style="font-weight: bold;">{{$attribute->name}} :</label>
    	<select class="form-control form-select js-example-basic-multiple" name="choice_options{{$attribute->id}}[]" id="choice_options{{$attribute->id}}" onchange="makeCombinationTable(this)" multiple data-placeholder="Nothing selected">
        	@foreach($attribute->attribute_values as $value)
        		<option value="{{ $value->value }}">{{ $value->value }}</option>
       		@endforeach
        </select>
	</div>
	@endforeach
</div>

<script>
	$(document).ready(function() {
    	$('.js-example-basic-multiple').select2();
	});
</script>