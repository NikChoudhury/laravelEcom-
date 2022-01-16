@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Brand")
@else
    @section("title","Add Brand")
@endif
@section("brand_active","active")
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
                    <div class="col-md-10 offset-md-1">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('brand.manage_brand_process')}}" method="post" name="brand_manage_form" id="brand_manage_form" enctype="multipart/form-data" class="form-validation-error">
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
                                        <!-- Row Start -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="brand_description" class="control-label mb-1">Brand Description</label>
                                                    <textarea id="brand_description" name="brand_description" type="text" class="form-control" rows="5" aria-required="true" aria-invalid="false">{{old('brand_description',$brand_description)}}</textarea> 
                                                    @if($errors->has('brand_description'))
                                                        <p class="text-danger mt-2">{{ $errors->first('brand_description') }}</p>
                                                    @endif
                                                </div>    

                                                
                                                <div class="form-group">
                                                    <label for="brand_staus" class="control-label mb-1">Status</label>
                                                    <select name="status" id="brand_staus" class="form-control mb-2">
                                                        <option value="1" @if (old('status',$status) == "1") {{ 'selected' }} @endif >Active</option>
                                                        <option value="0" @if (old('status',$status) == "0") {{ 'selected' }} @endif>Deactive</option>
                                                    </select>
                                                    @if($errors->has('status'))
                                                        <p class="text-danger mt-2">{{ $errors->first('status') }}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_home" class="control-label mb-1">Show In Home Page</label>
                                                    <input type="checkbox" name="is_home" id="is_home" @if($is_home == "1") {{'checked'}} @endif>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="image-box-card">
                                                    <div class="image-card-header card-image">
                                                        @if($brand_logo =='')
                                                        <img src="{{asset('admin_assets/images/icon/image-preview.png')}}" id="avatar-preview" class="img-preview ripple_animate" >
                                                        @else
                                                        <a href="{{asset('storage/uploads/brand/'.$brand_logo)}}" data-lightbox="{{$brand_logo}}" data-title="{{$brand_logo}}" class="image-link">
                                                            <img src="{{asset('storage/uploads/brand/'.$brand_logo)}}" id="avatar-preview" class="img-preview ripple_animate" >
                                                        </a>
                                                        @endif
                                                    </div>
                                                    <div class="image-card-footer">
                                                        <label for="select_brand_logo" class=""><i class="far fa-image"></i> Choose image</label>
                                                        <input type="file" name="brand_logo" id="select_brand_logo" class="image-box-input">
                                                    </div>
                                                </div>
                                                @if($errors->has('brand_logo'))
                                                    <p class="text-danger mt-2">{{ $errors->first('brand_logo') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Row END -->
                                        
                                       
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
