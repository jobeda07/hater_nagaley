@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Account Heads <span class="badge rounded-pill alert-success"> {{ count($account_heads) }} </span></h3>
        <div>
            <a href="{{ route('accounts.heads.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Add New</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Title</th> 
                            <th scope="col">Slug</th> 
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account_heads as $key => $head)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $head->title ?? '' }} </td>
                            <td> {{ $head->slug ?? '' }} </td>
                            <td>
                                @if($head->status == 1)
                                  <a href="{{ route('accounts.heads.change_status',['id'=>$head->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('accounts.heads.change_status',['id'=>$head->id]) }}" > <span class="badge rounded-pill alert-danger">Inactive</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Edit info</a>
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('52', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                            <a class="dropdown-item text-danger" href="{{ route('accounts.heads.delete',$head->id) }}" id="delete">Delete</a>
                                        @endif
                                    </div>
                                </div>
                                <!-- dropdown //end -->
                            </td>
                        </tr> 
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <!-- table-responsive //end -->
        </div>
        <!-- card-body end// -->
    </div>
</section>
@endsection

@push('footer-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.viweBtn', function(){
                var p_name = $(this).closest('tr').find('.p_name').text();
                // alert(p_name);
                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        'checking_view': true,
                        'p_name': p_name,
                    },
                    success: function(response){
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush