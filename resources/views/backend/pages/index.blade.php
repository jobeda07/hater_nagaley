@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h3 class="content-title">Page list <span class="badge rounded-pill alert-success"> {{ count($pages) }} </span></h3>
        <div>
            <a href="{{ route('page.create') }}" class="btn btn-primary"><i class="material-icons md-plus"></i>Page Create</a>
        </div>
    </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="table-responsive">
               <table id="example" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th> 
                            <th scope="col">Title</th> 
                            <th scope="col">Description</th> 
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $key => $page)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td class="p_name"> {{ $page->name_en ?? 'NULL' }} </td>
                            <td> {{ $page->title ?? 'NULL' }} </td>
                            <td> 
                                <?php $des =  strip_tags(html_entity_decode($page->description_en))?>
                                {{ Str::limit($des, $limit = 40, $end = '. . .') }}

                                <button type="button" class="btn btn-md rounded font-sm viweBtn">
                                <i class="fa fa-hand-pointer-o" aria-hidden="true"></i>Details
                                </button>

                                <!-- Show Modal -->
                                {{-- <button type="button" class="btn btn-md rounded font-sm" style="display: block;" data-bs-toggle="modal" data-bs-target="#viewModal{{ $page->id }}">
                                <i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Details
                                </button>
                                <!-- Scrollable modal -->
                                <div class="modal" id="viewModal{{ $page->id }}" tabindex="-1" role="dialog" aria-bs-labelledby="myModalLabel" aria-bs-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable text-left">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title text-center" id="myModalLabel">{{ $page->title }}</h4>
                                          <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="modal-body">
                                          <p>
                                            <span id="myModal-title"></span>
                                          <p>
                                          <p>{!! $page->description_en !!}</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--  Modal body end here  --> --}}


                            </td>
                            <td> {{ $page->position ?? 'NULL' }} </td>
                            <td>
                                @if($page->status == 1)
                                  <a href="{{ route('page.in_active',['id'=>$page->id]) }}">
                                    <span class="badge rounded-pill alert-success">Active</span>
                                  </a>
                                @else
                                  <a href="{{ route('page.active',['id'=>$page->id]) }}" > <span class="badge rounded-pill alert-danger">Disable</span></a>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-md rounded font-sm">Detail</a>
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('page.edit',$page->id) }}">Edit info</a>
                                        @if(Auth::guard('admin')->user()->role == '1' || in_array('52', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                            <a class="dropdown-item text-danger" href="{{ route('page.delete',$page->id) }}" id="delete">Delete</a>
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