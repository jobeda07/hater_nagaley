@extends('admin.admin_master')
@section('admin')

<style type="text/css">
    .nav_pills_custom .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #ffffff;
        background-color: rgb(59 183 126);
    }
    .nav_pills_custom .nav-link {
        padding: 0.55rem 3rem;
        border: none;
    }
</style>
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">SMS Templates <span class="badge rounded-pill alert-success"> {{ count($sms_templates) }} </span></h2>
        <div>
            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary"><i class="material-icons md-plus"></i> Add New Template</a>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('sms.templates.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SMS Templates Create</h5>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label for="name" class="col-form-label col-md-2" style="font-weight: bold;">Name:</label>
                                <input class="form-control" id="name" type="text" name="name" placeholder="Write name here" value="{{old('name')}}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="col-form-label col-md-2" for="body">SMS Body</label>
                               <textarea name="body" class="form-control" placeholder="Type.." rows="6" required id="body"></textarea>
                                <small class="form-text text-danger">{{ ('**N.B : Do Not Change The Variables Like [[ ____ ]].**') }}</small>
                                @error('body')
                                    <small class="form-text text-danger">{{ $message }}</small>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6 text-white">SMS Templates</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="d-flex align-items-start nav_pills_custom">
                            <div class="col-sm-4">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($sms_templates as $key => $sms_template)
                                    <button class="mt-2 nav-link @if($sms_template->id == 1) active @endif" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home{{ $sms_template->id }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ __(ucwords(str_replace('_', ' ', $sms_template->name)))  }}</button>
                                @endforeach
                              </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="tab-content" id="v-pills-tabContent">
                                    @foreach ($sms_templates as $key => $sms_template)
                                        <div class="tab-pane fade show @if($sms_template->id == 1) active @endif" id="v-pills-home{{ $sms_template->id }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <form action="{{ route('sms.templates.update', $sms_template->id) }}" method="POST">
                                                <!-- <input name="_method" type="hidden" value="PATCH"> -->
                                                    @csrf
                                                    @if($sms_template->identifier != 'phone_number_verification' && $sms_template->identifier != 'password_reset')
                                                        <div class="form-group row">
                                                            <div class="col-md-2">
                                                                <label class="form-check-label cursor">Activation</label>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <label class="aiz-switch aiz-switch-success mb-0">
                                                                    <input value="1" name="status" class="form-check-input" type="checkbox" @if ($sms_template->status == 1)
                                                                        checked
                                                                    @endif>
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-2 col-form-label">SMS Body</label>
                                                            <div class="col-md-10">
                                                                <textarea name="body" class="form-control" placeholder="Type.." rows="6" required>{{ $sms_template->body }}</textarea>
                                                                <small class="form-text text-danger">{{ ('**N.B : Do Not Change The Variables Like [[ ____ ]].**') }}</small>
                                                                @error('body')
                                                                    <small class="form-text text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row">
                                                            <label class="col-md-2 col-form-label">Template ID</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="template_id" value="" class="form-control" placeholder="{{__('Template Id')}}">
                                                                <small class="form-text text-danger">{{ ('**N.B : Template ID is Required Only for Fast2SMS DLT Manual**') }}</small>
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group mt-3 mb-3 " style="float: right;">
                                                            <button type="submit" class="btn btn-primary">Update Settings</button>
                                                        </div>
                                                    @endif
                                            </form>
                                        </div>
                                    @endforeach
                              </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection