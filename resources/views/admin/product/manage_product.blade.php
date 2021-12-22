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
                                                    <select name="category_id" id="category" class="form-control mb-2">
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
                                                    <select name="brand" id="brand" class="form-control mb-2">
                                                        <option value="">Please Select</option>
                                                        @foreach($brandData as $list)
                                                        <option value="{{$list->id}}" @if(old('brand',$brand) == $list->id){{'selected'}}@endif>{{$list->brand_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('brand'))
                                                        <p class="text-danger mt-2">{{ $errors->first('brand') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col col-md-12 col-12">
                                                    <label for="model" class="control-label mb-1">Model</label>
                                                    <input id="model" name="model" type="text" class="form-control mb-2" aria-required="true" aria-invalid="false" value="{{old('model',$model)}}">
                                                    @if($errors->has('model'))
                                                        <p class="text-danger mt-2">{{ $errors->first('model') }}</p>
                                                    @endif
                                                </div>
                                                <div class="col col-md-12 col-12">
                                                    <!-- <div class="form-group"> -->
                                                        <label for="keywords" class="control-label mb-1">Keywords</label>
                                                        <input type="text" name="keywords" id="keywords" class="form-control" value="{{old('keywords',$keywords)}}">
                                                        @if($errors->has('keywords'))
                                                            <p class="text-danger mt-2">{{ $errors->first('keywords') }}</p>
                                                        @endif
                                                    <!-- </div> -->
                                                </div>
                                            </div>                                                            
                                        </div>
                                        <!-- Col-8 End -->
                                        <!-- Col-4 Start -->
                                        <div class="col-md-4">
                                            <div class="row form-group">
                                                <div class="col col-md-12 col-12">
                                                    <div class="image-box-card">
                                                        <div class="image-card-header card-image">
                                                            @if($image =='')
                                                            <img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview" class="img-preview ripple_animate" >
                                                            @else
                                                            <a href="{{asset('storage/uploads/product/'.$image)}}" data-lightbox="{{$image}}" data-title="{{$image}}" class="image-link">
                                                                <img src="{{asset('storage/uploads/product/'.$image)}}" id="avatar-preview" class="img-preview ripple_animate" >
                                                            </a>
                                                            @endif
                                                        </div>
                                                        <div class="image-card-footer">
                                                            <label for="selectMainImage" class=""><i class="far fa-image"></i> Choose image</label>
                                                            <input type="file" name="image" id="selectMainImage" class="image-box-input">
                                                        </div>
                                                    </div>
                                                   
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

                                    <div class="form-group ">
                                        <label for="uses">Uses</label>
                                        <textarea name="uses" id="uses" cols="30" rows="5" class="form-control">{{old('uses',$uses)}}</textarea>
                                        @if($errors->has('uses'))
                                            <p class="text-danger mt-2">{{ $errors->first('uses') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group ">
                                        <label for="warranty">Warranty</label>
                                        <textarea name="warranty" id="warranty" cols="30" rows="5" class="form-control">{{old('warranty',$warranty)}}</textarea>
                                        @if($errors->has('warranty'))
                                            <p class="text-danger mt-2">{{ $errors->first('warranty') }}</p>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col col-md-8 col-12">
                                            <label for="lead_time" class="control-label mt-2 mb-1">Lead Time</label>
                                            <input type="text" name="lead_time" id="lead_time" class="form-control" value="{{old('lead_time',$lead_time)}}">
                                            @if($errors->has('lead_time'))
                                                <p class="text-danger mt-2">{{ $errors->first('lead_time') }}</p>
                                            @endif
                                        </div>
                                        <div class="col col-md-4 col-12">
                                            <label for="tax_id" class="control-label mt-2 mb-1">Tax</label>
                                            <select name="tax_id" id="tax_id" class="form-control mb-2" title="Select Tax">
                                                <option value="">Select Tax</option>
                                                @foreach($taxData as $list)
                                                <option value="{{$list->id}}" @if(old('tax_id',$tax_id) == $list->id){{'selected'}}@endif>{{$list->tax_desc}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('tax_id'))
                                                <p class="text-danger mt-2">{{ $errors->first('tax_id') }}</p>
                                            @endif
                                        </div>

                                        <div class="col col-md-3 col-12">
                                            <label for="is_promo" class="control-label mt-2 mb-1">Is Promotional</label>
                                            <select name="is_promo" id="is_promo" class="form-control">
                                                <option value="0" @if (old('is_promo',$is_promo) == "0") {{ 'selected' }} @endif>No</option>
                                                <option value="1" @if (old('is_promo',$is_promo) == "1") {{ 'selected' }} @endif >Yes</option>
                                            </select>
                                            @if($errors->has('is_promo'))
                                                <p class="text-danger mt-2">{{ $errors->first('is_promo') }}</p>
                                            @endif
                                        </div>

                                        <div class="col col-md-3 col-12">
                                            <label for="is_featured" class="control-label mt-2 mb-1">Is Featured</label>
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option value="0" @if (old('is_featured',$is_featured) == "0") {{ 'selected' }} @endif>No</option>
                                                <option value="1" @if (old('is_featured',$is_featured) == "1") {{ 'selected' }} @endif >Yes</option>
                                            </select>
                                            @if($errors->has('is_featured'))
                                                <p class="text-danger mt-2">{{ $errors->first('is_featured') }}</p>
                                            @endif
                                        </div>

                                        <div class="col col-md-3 col-12">
                                            <label for="is_discounted" class="control-label mt-2 mb-1">Is Discounted</label>
                                            <select name="is_discounted" id="is_discounted" class="form-control">
                                                <option value="0" @if (old('is_discounted',$is_discounted) == "0") {{ 'selected' }} @endif>No</option>
                                                <option value="1" @if (old('is_discounted',$is_discounted) == "1") {{ 'selected' }} @endif >Yes</option>
                                            </select>
                                            @if($errors->has('is_discounted'))
                                                <p class="text-danger mt-2">{{ $errors->first('is_discounted') }}</p>
                                            @endif
                                        </div>

                                        <div class="col col-md-3 col-12">
                                            <label for="is_tranding" class="control-label mt-2 mb-1">Is Tranding</label>
                                            <select name="is_tranding" id="is_tranding" class="form-control">
                                                <option value="0" @if (old('is_tranding',$is_tranding) == "0") {{ 'selected' }} @endif>No</option>
                                                <option value="1" @if (old('is_tranding',$is_tranding) == "1") {{ 'selected' }} @endif >Yes</option>
                                            </select>
                                            @if($errors->has('is_tranding'))
                                                <p class="text-danger mt-2">{{ $errors->first('is_tranding') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <hr>

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
                                     <!-- Header Start -->
                                     <div class="card mb-3">
                                        <div class="card-header">
                                            <h3>Product Images</h3>
                                        </div>
                                        <div class="card-body p-2">
                                            <div class="gird-image-box" id="moreImageBox">
                                                @php $loop_count_image = 0 @endphp
                                                @foreach($productImagesData as $key=>$val)
                                                @php $productImagesArray=(array)$val @endphp
                                                <input type="hidden" name="product_images_id[]" value="{{$productImagesArray['id']}}">
                                                <div class="image-box-card" id="imageCardBox_{{$loop_count_image}}">
                                                    <div class="image-card-header card-image" >
                                                        @if($productImagesArray['images'] =='')
                                                        <img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview_m_{{$loop_count_image}}" class="img-preview ripple_animate">
                                                        @if($loop_count_image>'2')
                                                        <button class="remove-image-btn" type="button" style="display: inline;" title="Remove">&#215;</button>
                                                        @endif
                                                        @else
                                                        <a href="{{asset('storage/uploads/product/product-images/'.$productImagesArray['images'])}}"  data-lightbox="{{$productImagesArray['images']}}" data-title="{{$productImagesArray['images']}}" class="image-link">
                                                            <img src="{{asset('storage/uploads/product/product-images/'.$productImagesArray['images'])}}" id="avatar-preview-{{$loop_count_image}}" class="img-preview ripple_animate">
                                                        </a>
                                                        <button class="remove-image-btn" type="button" style="display: inline;" title="Remove" onclick="openUrl('{{url('admin/product/remove_product_images')}}/{{$productImagesArray['id']}}/{{$id}}')">&#215;</button>
                                                        @endif
                                                    </div>
                                                    <div class="image-card-footer">
                                                        <label for="selectOtherImages_{{$loop_count_image}}" class=""><i class="far fa-image"></i> Choose image</label>
                                                        <input type="file" name="images[]" id="selectOtherImages_{{$loop_count_image}}" class="image-box-input">
                                                        @if($errors->has('images.'.$loop_count_image))
                                                             <p class="text-danger mt-2">{{ $errors->first('images.'.$loop_count_image) }}</p>
                                                        @endif
                                                    </div>
                                                   
                                                </div>
                                                @php $loop_count_image++ @endphp
                                                @endforeach 
                                                <div class="image-box-card" id="addMoreBtn">
                                                    <div class="image-card-header add-more-btn" >
                                                        <button class="btn btn-info form-control" type="button" onclick="addMoreImage()" title="Add More Images">Add More <i class="fa fa-plus" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!-- Header END -->
                                    <!-- Header Start -->
                                    <div class="card mb-1">
                                        <div class="card-header">
                                            <h3>Product Attributes</h3>
                                        </div>
                                    </div>
                                    <!-- Header END -->
                                    <!-- Product Attribute box Start -->
                                    <div id="productAttributeBox">
                                        @php $loop_count = 0 @endphp
                                        @foreach($productAttributeData as $key=>$val)
                                        @php $productAttrArray=(array)$val @endphp
                                        
                                        <!-- Attribute card Start -->
                                        <div id="productAttrCard_{{$loop_count}}" class="card border-dark">
                                            <!-- Card Body Start -->
                                            <div class="card-body">
                                                <!-- Row Start -->
                                                <div class="row">
                                                    <!-- Col 8 Start -->
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <input type="hidden" name="product_attr_id[]" value="{{$productAttrArray['id']}}">
                                                                <label for="sku_{{$loop_count}}" class="control-label mb-1">SKU*</label>
                                                                <input id="sku_{{$loop_count}}" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('sku.'.$loop_count,$productAttrArray['sku'])}}">
                                                                @if($errors->has('sku.'.$loop_count))
                                                                    <p class="text-danger mt-2">{{ $errors->first('sku.'.$loop_count) }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <label for="mrp_{{$loop_count}}" class="control-label mb-1">MRP*</label>
                                                                <input id="mrp_{{$loop_count}}" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('mrp.'.$loop_count,$productAttrArray['mrp'])}}">
                                                                @if($errors->has('mrp.'.$loop_count))
                                                                    <p class="text-danger mt-2">{{ $errors->first('mrp.'.$loop_count) }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <label for="price_{{$loop_count}}" class="control-label mb-1">Price*</label>
                                                                <input id="price_{{$loop_count}}" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('price.'.$loop_count,$productAttrArray['price'])}}">
                                                                @if($errors->has('price.'.$loop_count))
                                                                    <p class="text-danger mt-2">{{ $errors->first('price.'.$loop_count) }}</p>
                                                                @endif
                                                            </div>
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <label for="qty_{{$loop_count}}" class="control-label mb-1">Quantity*</label>
                                                                <input id="qty_{{$loop_count}}" name="qty[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('qty.'.$loop_count,$productAttrArray['qty'])}}">
                                                                @if($errors->has('qty.'.$loop_count))
                                                                    <p class="text-danger mt-2">{{ $errors->first('qty.'.$loop_count) }}</p>
                                                                @endif
                                                            </div>
                                                                                                                
                                                            
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <div id="sizeCol">
                                                                    <label for="size_id_{{$loop_count}}" class="control-label mb-1">Size</label>
                                                                    <select name="size_id[]" id="size_id_{{$loop_count}}" class="form-control">
                                                                        <option value="">Select Size</option>
                                                                        @foreach($sizeData as $list)
                                                                        <option value="{{$list->id}}" @if(old("size_id.".$loop_count,$productAttrArray['size_id']) == $list->id){{'selected'}}@endif>{{$list->size}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('size_id.'.$loop_count))
                                                                        <p class="text-danger mt-2">{{ $errors->first('size_id.'.$loop_count) }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col col-md-6 col-12 form-group">
                                                                <div id="colorCol">
                                                                    <label for="color_id_{{$loop_count}}" class="control-label mb-1">Color</label>
                                                                    <select name="color_id[]" id="color_id_{{$loop_count}}" class="form-control">
                                                                        <option value="">Select Color</option>
                                                                        @foreach($colorData as $list)
                                                                        <option value="{{$list->id}}" @if(old('color_id.'.$loop_count,$productAttrArray['color_id']) == $list->id){{'selected'}}@endif>{{$list->color_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if($errors->has('color_id.'.$loop_count))
                                                                        <p class="text-danger mt-2">{{ $errors->first('color_id.'.$loop_count) }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Col 8 END -->
                                                    <!-- Col 4 Start -->
                                                    <div class="col col-md-4 col-12">
                                                        <div class="image-box-card">
                                                            <div class="image-card-header card-image ">
                                                                @if($productAttrArray['attr_image'] =='')
                                                                <img src="https://rkdfuniversity.org/assets/Assets/images/image-preview.png" id="avatar-preview{{$loop_count}}" class="img-preview ripple_animate" style="height:250px;" >
                                                                @else
                                                                <a href="{{asset('storage/uploads/product/attributes-image/'.$productAttrArray['attr_image'])}}"  data-lightbox="{{$productAttrArray['attr_image']}}" data-title="{{$productAttrArray['attr_image']}}" class="image-link">
                                                                    <img src="{{asset('storage/uploads/product/attributes-image/'.$productAttrArray['attr_image'])}}" id="avatar-preview{{$loop_count}}" class="img-preview ripple_animate" style="height:250px;" >
                                                                </a>
                                                                @endif
                                                            </div>
                                                            <div class="image-card-footer">
                                                                <label for="attr_image_{{$loop_count}}" class=""><i class="far fa-image"></i> Choose image</label>
                                                                <input type="file" name="attr_image[]" id="attr_image_{{$loop_count}}" class="image-box-input" aria-required="true" aria-invalid="false" value="{{old('attr_image.'.$loop_count,$productAttrArray['attr_image'])}}">
                                                            </div>
                                                        </div>
                                                    
                                                        @if($errors->has('attr_image.'.$loop_count))
                                                            <p class="text-danger mt-2">{{ $errors->first('attr_image.'.$loop_count) }}</p>
                                                        @endif
                                                    </div>
                                                    <!-- Col 4 END -->
                                                    
                                                    <div class="col-md-4 col-sm-4 form-group">
                                                        @if($loop_count<'1')
                                                        <button class="btn btn-info form-control" type="button" onclick="addMoreAttribute()">Add More</button>
                                                        @else
                                                        <button class="btn btn-warning form-control" type="button" onclick="openUrl('{{url('admin/product/remove_product_attr')}}/{{$productAttrArray['id']}}/{{$id}}')">Remove</button>
                                                        @endif
                                                    </div>     
                                                </div>
                                                <!-- Row END -->
                                            </div>
                                            <!-- Card Body End -->
                                            
                                        </div>
                                        @php $loop_count++ @endphp
                                        @endforeach  
                                        <!-- Attribute card END -->                                               
                                    </div>
                                    <!-- Product Attribute box END -->
                                    
                                    <div>
                                        <button id="save-button" type="submit" class="btn btn-lg btn-success btn-block">
                                            <span id="save-button-amount">{{ $id > '0' ? "Update" : "Save"}}</span>
                                            <span id="save-button-sending" style="display:none;">Sending…</span>
                                        </button>
                                    </div>             
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
<script src="{{asset('admin_assets/vendor/validateJs/jquery.validate.js')}}"></script>
<script src="{{asset('admin_assets/vendor/validateJs/additional-methods.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/ckeditor/ckeditor.js')}}" ></script>
<script src="{{asset('admin_assets/js/mainValidation.js')}}" defer></script>
<!-- Image Requierd Validation -->
<script>
    var isImageRequired = {{ $id > '0' ? "false" : "true"}}
</script>
<script>
    let loopCount = {{$loop_count-1}};
    let loopCountForImg = {{$loop_count_image-1}};
</script>
<!-- Image Requierd Validation END-->
@endpush
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
    @if(Session::has('warning'))
        toastr.warning("{{session('warning') }}");
    @endif
</script>
<!-- CK Editor -->
<script>
CKEDITOR.replace('short_desc');desc
CKEDITOR.replace('desc');
CKEDITOR.replace('technical_specification');
CKEDITOR.replace('uses');
CKEDITOR.replace('warranty');
</script>
<!-- END CK Editor -->
@endpush

