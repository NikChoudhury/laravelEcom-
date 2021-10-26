@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Brand")
@else
    @section("title","Add Brand")
@endif
@section("brand_active","active")
@push('style-lib')
<!-- <link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all"> -->
@endpush
@push('style')
<style>
        #main_form .error{color:red;margin-top: 5px;}
    </style>
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
                                            <a href="{{url('admin/brand')}}">Brand</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Brand" : "Add Brand"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Brand" : "Add Brand"}}</h1>
                                <a href="{{url('admin/brand')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
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
                    <div class="col-md-8 offset-md-2">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('brand.manage_brand_process')}}" method="post" name="main_form" id="main_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="brand_name" class="control-label mb-1">Brand Name</label>
                                        <input id="brand_name" name="brand_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('brand_name',$brand_name)}}">
                                        @if($errors->has('brand_name'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_name') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_website" class="control-label mb-1">Brand Site Link</label>
                                        <input id="brand_website" name="brand_website" type="text" class="form-control" placeholder="https://www.example.com" aria-required="true" aria-invalid="false" value="{{old('brand_website',$brand_website)}}">
                                        @if($errors->has('brand_website'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_website') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_logo" class="control-label mb-1">Brand Logo</label>
                                        <input id="brand_logo" name="brand_logo" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{old('brand_logo',$brand_logo)}}">
                                        @if($errors->has('brand_logo'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_logo') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_description" class="control-label mb-1">Brand Description</label>
                                        <textarea id="brand_description" name="brand_description" type="text" class="form-control" rows="5" aria-required="true" aria-invalid="false">{{old('brand_description',$brand_description)}}</textarea> 
                                        @if($errors->has('brand_description'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_description') }}</p>
                                        @endif
                                    </div>
                                    {{--
                                    <!-- 
                                    <div class="form-group">
                                        <label for="brand_warranty_details" class="control-label mb-1">Brand Description</label>
                                        <textarea id="brand_warranty_details" name="brand_warranty_details" type="text" class="form-control" rows="5" aria-required="true" aria-invalid="false">{{old('brand_warranty_details',$brand_warranty_details)}}</textarea> 
                                        @if($errors->has('brand_warranty_details'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_warranty_details') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_contact_info" class="control-label mb-1">Brand Description</label>
                                        <textarea id="brand_contact_info" name="brand_contact_info" type="text" class="form-control" rows="5" aria-required="true" aria-invalid="false">{{old('brand_contact_info',$brand_contact_info)}}</textarea> 
                                        @if($errors->has('brand_contact_info'))
                                            <p class="text-danger mt-2">{{ $errors->first('brand_contact_info') }}</p>
                                        @endif
                                    </div>
                                     -->
                                    --}}
                                    <div class="form-group">
                                        <label for="brand_staus" class="control-label mb-1">Status</label>
                                        <select name="status" id="brand_staus" class="form-control">
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
<script src="{{asset('admin_assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_assets/js/additional-methods.min.js')}}"></script>
<script src="{{asset('admin_assets/js/customValidationFunction.js')}}"></script>
@endpush

@push('script')
<script>
        $(function(){
            $("form[name='main_form']").validate({
                rules:{
                    brand_name:{
                        required:true,
                        minlength:1,
                        noSpace: true
                    },
                    brand_logo:{
                        extension: "png|jpe?g|gif"
                    },
                    brand_website: "noSpace",
                    brand_description: "noSpace",
                    status:{
                        required:true,
                    }
                },
                messages:{
                    brand_name: {
                        required: "Please Insert Brand Name !!",
                        minlength: "Atleast 1 character required !!"
                    },
                    status: "Please Select Status !!!"
                }
            });
        });
    </script>
@endpush