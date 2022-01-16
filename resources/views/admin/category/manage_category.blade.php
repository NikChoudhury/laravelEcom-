@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Category")
@else
    @section("title","Add Category")
@endif
@section("category_active","active")
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
                                            <a href="{{url('admin/category')}}">Category</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Category" : "Add Category"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Category" : "Add Category"}}</h1>
                                <a href="{{url('admin/category')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
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
                    <div class="col-md-12 ">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('category.manage_category_process')}}" method="post" name="category_manage_form" id="category_manage_form" class="form-validation-error" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                                <input id="category_name" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_name',$category_name)}}">
                                                @if($errors->has('category_name'))
                                                    <p class="text-danger mt-2">{{ $errors->first('category_name') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('category_slug',$category_slug)}}">
                                                @if($errors->has('category_slug'))
                                                    <p class="text-danger mt-2">{{ $errors->first('category_slug') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_category" class="control-label mb-1">Parent Category</label>
                                                <select name="parent_category_id" id="parent_category" class="form-control mb-2" title="Parent Category">
                                                    <option value="">Select Category</option>
                                                    @foreach($categoryData as $list)
                                                    <option value="{{$list->id}}" @if(old('parent_category_id',$parent_category_id) == $list->id){{'selected'}}@endif>{{$list->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('parent_category_id'))
                                                    <p class="text-danger mt-2">{{ $errors->first('parent_category_id') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="category_status" class="control-label mb-1">Status</label>
                                                <select name="category_status" id="category_status" class="form-control">
                                                    <option value="1" @if (old('category_status',$category_status) == "1") {{ 'selected' }} @endif >Active</option>
                                                    <option value="0" @if (old('category_status',$category_status) == "0") {{ 'selected' }} @endif>Deactive</option>
                                                </select>
                                                @if($errors->has('category_status'))
                                                    <p class="text-danger mt-2">{{ $errors->first('category_status') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="is_home" class="control-label mb-1">Show In Home Page</label>
                                                <input type="checkbox" name="is_home" id="is_home" @if($is_home == "1") {{'checked'}} @endif>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Image</label>
                                            <div class="image-box-card">
                                                <div class="image-card-header card-image">
                                                    @if($category_image =='')
                                                    <img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview" class="img-preview ripple_animate" >
                                                    @else
                                                    <a href="{{asset('storage/uploads/category/'.$category_image)}}" data-lightbox="{{$category_image}}" data-title="{{$category_image}}" class="image-link">
                                                        <img src="{{asset('storage/uploads/category/'.$category_image)}}" id="avatar-preview" class="img-preview ripple_animate" >
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="image-card-footer">
                                                    <label for="selectMainImage" class=""><i class="far fa-image"></i> Choose image</label>
                                                    <input type="file" name="category_image" id="selectMainImage" class="image-box-input">
                                                </div>
                                            </div>
                                            
                                            @if($errors->has('category_image'))
                                                <p class="text-danger mt-2">{{ $errors->first('category_image') }}</p>
                                            @endif
                                        </div>
                                        
                                    </div>
                                    <input type="hidden" name="id" value="{{$id}}">       
                                    <div>
                                        <button id="save-button" type="submit" class="btn mt-2 btn-lg btn-info btn-block">
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
