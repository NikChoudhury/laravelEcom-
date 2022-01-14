@extends('admin.layouts.app')
@section("title","Customer Details")
@section("customer_active","active")

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
                                            <a href="{{url('admin/customer')}}">Customer</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Customer Details</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">Customer Details</h1>
                                <a href="{{url('admin/customer')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- END BREADCRUMB-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="data-div data-grid-contanier">
                                <div class="table-row-data ">
                                    <div><span>Name :</span></div>
                                    <div><span>{{$customer_data->name}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Email :</span></div>
                                    <div><span>{{maskedEmail($customer_data->email)}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Mobile :</span></div>
                                    <div><span>{{maskedMobileNumber($customer_data->mobile)}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Address :</span></div>
                                    <div><span>{{$customer_data->address}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>City :</span></div>
                                    <div><span>{{$customer_data->city}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>State :</span></div>
                                    <div><span>{{$customer_data->state}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Pin :</span></div>
                                    <div><span>{{$customer_data->pin}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Country :</span></div>
                                    <div><span>{{$customer_data->country}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Is Email Verified :</span></div>
                                    <div><span>{{$customer_data->is_email_verified== "1" ? "Yes" : "No"}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Is Mobile Verified :</span></div>
                                    <div><span>{{$customer_data->is_mobile_verified== "1" ? "Yes" : "No"}}</span></div>
                                </div>
                                <div class="table-row-data">
                                    <div><span>Added On :</span></div>
                                    <div><span>{{\Carbon\Carbon::parse($customer_data->created_at)->format('d-M-Y / h:i A')}}</span></div>
                                </div>
                                <div class="table-row-data">
                                    <div><span>Update On :</span></div>
                                    <div><span>{{\Carbon\Carbon::parse($customer_data->update_on)->format('d-M-Y / h:i A')}}</span></div>
                                </div>
                                <div class="table-row-data ">
                                    <div><span>Status :</span></div>
                                    <div><span><a onclick="openUrl('{{url('admin/customer/status')}}/{{ $customer_data->status == '1' ? 'active' : 'deactive'}}/{{$customer_data->id}}')" class="btn badge rounded-pill text-dark {{ $customer_data->status == '1' ? 'bg-success' : 'bg-warning'}}"> {{ $customer_data->status == '1' ? "Active" : "Deactive"}}</a></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <!-- END Section-->  
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