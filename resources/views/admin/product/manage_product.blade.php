@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Product")
@else
    @section("title","Add Product")
@endif
@section("product_active","active")

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
                                            <a href="{{url('admin/product')}}">Product</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Product" : "Add Product"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Product" : "Add Product"}}</h1>
                                <a href="{{url('admin/product')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
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
                    <div class="col-md-12">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('product.manage_product_process')}}" method="post" name="admin_product_manage_form" id="product_manage_form" enctype="multipart/form-data" class="form-validation-error">
                                    @csrf
                                    <div class="form-group">
                                        <label for="p_name" class="control-label mb-1">Product Name*</label>
                                        <input id="p_name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('name',$name)}}">
                                        @if($errors->has('name'))
                                            <p class="text-danger mt-2">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                    <!-- ROW Start -->
                                    <div class="row">
                                        <!-- Col-8 Start -->
                                        <div class="col-md-8">
                                            <div class="row form-group">
                                                <div class="col col-md-6 col-12">
                                                    <label for="category" class="control-label mb-1">Category*</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach($categoryData as $list)
                                                        <option value="{{$list->id}}" @if(old('category_id',$category_id) == $list->id){{'selected'}}@endif>{{$list->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('category_id'))
                                                        <p class="text-danger mt-2">{{ $errors->first('category_id') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col col-md-6 col-12">
                                                    <label for="brand" class="control-label mb-1">Brand</label>
                                                    <select name="brand" id="brand" class="form-control">
                                                        <option value="">Please Select</option>
                                                        @foreach($brandData as $list)
                                                        <option value="{{$list->id}}" @if(old('brand',$brand) == $list->id){{'selected'}}@endif>{{$list->brand_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('brand'))
                                                        <p class="text-danger mt-2">{{ $errors->first('brand') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col col-md-6 col-12">
                                                    <label for="model" class="control-label mb-1">Model</label>
                                                    <input id="model" name="model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('model',$model)}}">
                                                    @if($errors->has('model'))
                                                        <p class="text-danger mt-2">{{ $errors->first('model') }}</p>
                                                    @endif
                                                </div>
                                            </div>                                                            
                                        </div>
                                        <!-- Col-8 End -->
                                        <!-- Col-4 Start -->
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <div class="col col-md-12 col-12">
                                                    <label for="image" class="control-label mb-1">Image</label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                    @if($errors->has('image'))
                                                        <p class="text-danger mt-2">{{ $errors->first('image') }}</p>
                                                    @endif
                                                </div>
                                            </div>    
                                        </div>
                                        <!-- Col-4 END -->
                                    </div>
                                    <!-- Row END -->
                                    <div class="form-group">
                                        <label for="keywords">Keywords</label>
                                        <input type="text" name="keywords" id="keywords" class="form-control" value="{{old('keywords',$keywords)}}">
                                        @if($errors->has('keywords'))
                                            <p class="text-danger mt-2">{{ $errors->first('keywords') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="short_desc">Short Description</label>
                                        <textarea name="short_desc" id="short_desc" cols="30" rows="5" class="form-control">{{old('short_desc',$short_desc)}}</textarea>
                                        @if($errors->has('short_desc'))
                                            <p class="text-danger mt-2">{{ $errors->first('short_desc') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="desc" cols="30" rows="5" class="form-control">{{old('desc',$desc)}}</textarea>
                                        @if($errors->has('desc'))
                                            <p class="text-danger mt-2">{{ $errors->first('desc') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="technical_specification">Technical Specification</label>
                                        <textarea name="technical_specification" id="technical_specification" cols="30" rows="5" class="form-control">{{old('technical_specification',$technical_specification)}}</textarea>
                                        @if($errors->has('technical_specification'))
                                            <p class="text-danger mt-2">{{ $errors->first('technical_specification') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="uses">Uses</label>
                                        <textarea name="uses" id="uses" cols="30" rows="5" class="form-control">{{old('uses',$uses)}}</textarea>
                                        @if($errors->has('uses'))
                                            <p class="text-danger mt-2">{{ $errors->first('uses') }}</p>
                                        @endif
                                    </div>

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
<script src="{{asset('admin_assets/vendor/validateJs/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/validateJs/additional-methods.min.js')}}"></script>
<script src="{{asset('admin_assets/js/mainValidation.js')}}" defer></script>
<!-- Image Requierd Validation -->
<script>
    let isImageRequired = {{ $id > '0' ? "false" : "true"}}
</script>
<!-- Image Requierd Validation END-->
@endpush
