@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Coupon")
@else
    @section("title","Add Coupon")
@endif
@section("coupon_active","active")
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
                                            <a href="{{url('admin/coupon')}}">Coupon</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Coupon" : "Add Coupon"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Coupon" : "Add Coupon"}}</h1>
                                <a href="{{url('admin/coupon')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- END BREADCRUMB-->
    
    <!-- Category-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('coupon.manage_coupon_process')}}" method="post" name="coupon_manage_form" id="coupon_manage_form" class="form-validation-error">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="coupon_title" class="control-label mb-1">Coupon Name</label>
                                                <input id="coupon_title" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('title',$title)}}">
                                                @if($errors->has('title'))
                                                    <p class="text-danger mt-2">{{ $errors->first('title') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                                                <input id="coupon_code" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('code',$code)}}">
                                                @if($errors->has('code'))
                                                    <p class="text-danger mt-2">{{ $errors->first('code') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                                                <input id="coupon_value" name="value" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('value',$value)}}">
                                                @if($errors->has('value'))
                                                    <p class="text-danger mt-2">{{ $errors->first('value') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type" class="control-label mb-1">Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="value" @if (old('type',$type) == "value") {{ 'selected' }} @endif >Value</option>
                                                    <option value="per" @if (old('type',$type) == "per") {{ 'selected' }} @endif>Per</option>
                                                </select>
                                                @if($errors->has('type'))
                                                    <p class="text-danger mt-2">{{ $errors->first('type') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="min_order_amt" class="control-label mb-1">Min Order Amount</label>
                                                <input id="min_order_amt" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('min_order_amt',$min_order_amt)}}">
                                                @if($errors->has('min_order_amt'))
                                                    <p class="text-danger mt-2">{{ $errors->first('min_order_amt') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                                                <select name="is_one_time" id="is_one_time" class="form-control">
                                                    
                                                    <option value="0" @if (old('is_one_time',$is_one_time) == "0") {{ 'selected' }} @endif>No</option>
                                                    <option value="1" @if (old('is_one_time',$is_one_time) == "1") {{ 'selected' }} @endif >Yes</option>
                                                </select>
                                                @if($errors->has('is_one_time'))
                                                    <p class="text-danger mt-2">{{ $errors->first('is_one_time') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="coupon_status" class="control-label mb-1">Status</label>
                                                <select name="status" id="coupon_status" class="form-control">
                                                    <option value="1" @if (old('status',$status) == "1") {{ 'selected' }} @endif >Active</option>
                                                    <option value="0" @if (old('status',$status) == "0") {{ 'selected' }} @endif>Deactive</option>
                                                </select>
                                                @if($errors->has('status'))
                                                    <p class="text-danger mt-2">{{ $errors->first('status') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    
                                   
                                    <input type="hidden" name="id" value="{{$id}}">       
                                    <div>
                                        <button id="save-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="save-button-amount">{{ $id > '0' ? "Update" : "Save"}}</span>
                                            <span id="save-button-sending" style="display:none;">Sending…</span>
                                        </button>
                                    </div>
                                    @if(session('message'))
                                        <div class="alert alert-success mt-2" role="alert">
                                            {{session('message')}}
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <!-- Card END -->
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <!-- END Category-->  
    
   

@endsection
@push('script-lib')
<script src="{{asset('admin_assets/vendor/validateJs/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/validateJs/additional-methods.min.js')}}"></script>
<script src="{{asset('admin_assets/js/mainValidation.js')}}" defer></script>
@endpush
