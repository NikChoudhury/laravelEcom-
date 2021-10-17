@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Category")
@else
    @section("title","Add Category")
@endif
@push('style-lib')
<!-- <link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all"> -->
@endpush
@push('style')
<style>
        #category_manage_form .error{color:red;margin-top: 5px;}
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
                    <div class="col-md-8 offset-md-2">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('category.manage_category_process')}}" method="post" name="category_manage_form" id="category_manage_form">
                                    @csrf
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
                                        <label for="category_status" class="control-label mb-1">Status</label>
                                        <select name="category_status" id="category_status" class="form-control">
                                            <option value="1" @if (old('category_status',$category_status) == "1") {{ 'selected' }} @endif >Active</option>
                                            <option value="0" @if (old('category_status',$category_status) == "0") {{ 'selected' }} @endif>Deactive</option>
                                        </select>
                                        @if($errors->has('category_status'))
                                            <p class="text-danger mt-2">{{ $errors->first('category_status') }}</p>
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
@endpush

@push('script')
<script>
        $(function(){
            $("form[name='category_manage_form']").validate({
                rules:{
                    category_name:{
                        required:true,
                        minlength:2
                    },
                    category_slug:{
                        required:true,
                        minlength:2
                    },
                    category_status:{
                        required:true,
                    }
                },
                messages:{
                    category_name: {
                        required: "Please Insert Category Name !!",
                        minlength: "Atleast 2 character required !!"
                    },
                    category_slug: {
                        required: "Please Insert Category Slug !!",
                        minlength: "Atleast 2 character required !!"
                    },
                    category_status: "Please Select Category Status !!!"
                }
            });
        });
    </script>
@endpush