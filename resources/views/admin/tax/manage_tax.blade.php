@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Tax")
@else
    @section("title","Add Tax")
@endif
@section("tax_active","active")
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
                                            <a href="{{url('admin/tax')}}">Tax</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit tax" : "Add tax"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit tax" : "Add tax"}}</h1>
                                <a href="{{url('admin/tax')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
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
                                <form action="{{route('tax.manage_tax_process')}}" method="post" name="tax_manage_form" id="tax_manage_form" enctype="multipart/form-data" class="form-validation-error">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tax_value" class="control-label mb-1">Tax Value</label>
                                        <input id="tax_value" name="tax_value" type="text" class="form-control"  aria-required="true" aria-invalid="false" value="{{old('tax_value',$tax_value)}}">
                                        @if($errors->has('tax_value'))
                                            <p class="text-danger mt-2">{{ $errors->first('tax_value') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="tax_desc" class="control-label mb-1">Tax Name</label>
                                        <input id="tax_desc" name="tax_desc" type="text" class="form-control" placeholder="GST 12%" aria-required="true" aria-invalid="false" value="{{old('tax_desc',$tax_desc)}}">
                                        @if($errors->has('tax_desc'))
                                            <p class="text-danger mt-2">{{ $errors->first('tax_desc') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="size_status" class="control-label mb-1">Status</label>
                                        <select name="status" id="size_status" class="form-control">
                                            <option value="1" @if (old('status',$status) == "1") {{ 'selected' }} @endif >Active</option>
                                            <option value="0" @if (old('status',$status) == "0") {{ 'selected' }} @endif>Deactive</option>
                                        </select>
                                        @if($errors->has('status'))
                                            <p class="text-danger mt-2">{{ $errors->first('status') }}</p>
                                        @endif
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
<script src="{{asset('admin_assets/vendor/validateJs/jquery.validate.min.js')}}" defer></script>
<script src="{{asset('admin_assets/vendor/validateJs/additional-methods.min.js')}}" defer></script>
<script src="{{asset('admin_assets/js/mainValidation.js')}}" defer></script>
@endpush
