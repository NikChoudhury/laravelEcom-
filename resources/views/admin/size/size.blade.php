@extends('admin.layouts.app')
@section("title","Size")
@section("size_active","active")
@push('style-lib')
<link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
@endpush
@section('panel')
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb m-t-75">
            <div class="section__content section__content--p30">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="dashboard">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Size</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">Size</h1>
                                <a href="{{url('admin/size/manage_size')}}" class="au-btn au-btn-icon au-btn--green"><i class="zmdi zmdi-plus"></i>Add Size</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- END BREADCRUMB-->
    
    <!-- Start Section-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                        <!-- DATA TABLE-->
                        @if(!$data->isEmpty())
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    
                                        @foreach($data as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->size}}</td>
                                            <td><a onclick="openUrl('{{url('admin/size/status')}}/{{ $list->status == '1' ? 'active' : 'deactive'}}/{{$list->id}}')" class="btn badge rounded-pill text-dark {{ $list->status == '1' ? 'bg-success' : 'bg-warning'}}"> {{ $list->status == '1' ? "Active" : "Deactive"}}</a></td>
                                            <td style="display:flex;align-items: center;justify-content: flex-end">
                                                <p onclick="openUrl('{{url('admin/size/remove')}}/{{$list->id}}')"  class="btn btn-outline-danger" ><i class="fas fa-trash-alt"></i></p> &nbsp
                                                <p onclick="openUrl('{{url('admin/size/manage_size')}}/{{$list->id}}')" class="btn btn-outline-info"><i class="fas fa-pencil-alt"></i></p>
                                            </td>
                                        </tr>
                                        @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p>No Data Found !!</p> 
                        @endif
                        <!-- END DATA TABLE-->
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <!-- END Size-->  
    
   

@endsection

@push('script')
<script>
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true,
        'preventDuplicates' : true,
        "positionClass": "toast-bottom-center",
    }
    @if(Session::has('message'))
        
        toastr.success("{{ session('message') }}");
    @endif
    @if(Session::has('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@endpush