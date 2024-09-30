@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">SMS Providers Configuration</h2>
        <div>
            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-primary"><i class="material-icons md-plus"></i> Add New Provider</a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('sms.providers.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SMS Providers Create</h5>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="name" class="col-form-label col-md-3" style="font-weight: bold;">Provider Name:</label>
                                <input class="form-control" id="name" type="text" name="name" placeholder="Write name here" value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="url" class="col-form-label col-md-3" style="font-weight: bold;">Provider URL:</label>
                                <input class="form-control" id="url" type="text" name="url" placeholder="Write url here" value="{{old('url')}}">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="api_key" class="col-form-label col-md-3" style="font-weight: bold;">Api Key:</label>
                                <input class="form-control" id="api_key" type="text" name="api_key" placeholder="Write api key here" value="{{old('api_key')}}">
                                @error('api_key')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="sender_id" class="col-form-label col-md-3" style="font-weight: bold;">Sender ID:</label>
                                <input class="form-control" id="sender_id" type="text" name="sender_id" placeholder="Write sender id here" value="{{old('sender_id')}}">
                                @error('sender_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="form-check-label cursor" for="activation">Activation</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input value="1" name="status" class="form-check-input" type="checkbox" id="activation" style="cursor: pointer;"> 
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
    </div> 
		<div class="row">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
		
        	@if(count($sms_providers) > 0)
	        	@foreach($sms_providers as $sms_provider)
		        	<div class="col-sm-6">
						<div class="card">
							<div class="card-header">
								<h3>{{ $sms_provider->name }}</h3>
							</div>
				        	<div class="card-body" style="font-size: 12px;">
				        		<form method="post" action="{{ route('sms.providers.update', $sms_provider->id) }}" enctype="multipart/form-data">
									@csrf
									<div class="form-group row mb-2">
			                            <div class="col-md-4">
			                                <label class="col-from-label">{{ __('Provider Name')}}</label>
			                            </div>
			                            <div class="col-md-8">
			                                <input type="text" class="form-control" name="name" value="{{ $sms_provider->name }}" placeholder="{{__('Provider Name')}}" required>
			                            </div>
			                        </div>
			                        <div class="form-group row mb-2">
			                            <div class="col-md-4">
			                                <label class="col-from-label">{{__('URL')}}</label>
			                            </div>
			                            <div class="col-md-8">
			                                <input type="text" class="form-control" name="url" value="{{ $sms_provider->url }}" placeholder="{{__('URL')}}" required>
			                            </div>
			                        </div>
			                        <div class="form-group row mb-2">
			                            <div class="col-md-4">
			                                <label class="col-from-label">{{__('API Key')}}</label>
			                            </div>
			                            <div class="col-md-8">
			                                <input type="text" class="form-control" name="api_key" value="{{ $sms_provider->api_key }}" placeholder="{{__('API Key')}}" required>
			                            </div>
			                        </div>
			                        <div class="form-group row mb-2">
			                            <div class="col-md-4">
			                                <label class="col-from-label">{{__('Sender ID')}}</label>
			                            </div>
			                            <div class="col-md-8">
			                                <input type="text" class="form-control" name="sender_id" value="{{ $sms_provider->sender_id }}" placeholder="{{__('Sender ID')}}" required>
			                            </div>
			                        </div>
			                        <div class="form-group row mb-2">
			                            <div class="col-md-4">
			                                <label class="col-from-label">{{__('Activation')}}</label>
			                            </div>
			                            <div class="col-md-8">
			                                <label class="aiz-switch aiz-switch-success mb-0">
			                                    <input value="1" name="status" type="checkbox" @if ($sms_provider->status == 1)
                                                                        checked
                                                                    @endif>
			                                    <span class="slider round"></span>
			                                </label>
			                            </div>
			                        </div>
			                        <div class="form-group mb-0 text-right">
			                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
			                        </div>
								</form>
				        	</div>
				        	<!-- card body .// -->
					    </div>
					    <!-- card .// -->   
					</div>
				@endforeach
			@endif
		
		<!-- col-6 //-->

		</div>
</section>

@endsection



@push('footer-script')

@endpush