@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Color")
@else
    @section("title","Add Color")
@endif
@section("color_active","active")
@push('style-lib')
<!-- <link href="{{asset('admin_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all"> -->
<link rel="stylesheet" href="{{asset('admin_assets/vendor/coloris/coloris.min.css')}}"/>
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
                                            <a href="{{url('admin/color')}}">Color</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Color" : "Add Color"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Color" : "Add Color"}}</h1>
                                <a href="{{url('admin/color')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- END BREADCRUMB-->
    
    <!-- Main Section-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <!-- Card Start -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('color.manage_color_process')}}" method="post" name="color_manage_form" id="color_manage_form" class="form-validation-error">
                                    @csrf
                                    <div class="form-group color-code-div">
                                        <label for="title1" class="control-label mb-1">Color Code</label>
                                        <br>
                                        <input id="title1" name="color_code" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('color_code',$color_code)}}" data-coloris>
                                        @if($errors->has('color_code'))
                                            <p class="text-danger mt-2">{{ $errors->first('color_code') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group color-name-div">
                                        <label for="title2" class="control-label mb-1">Color Name</label>
                                        <input id="title2" name="color_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('color_name',$color_name)}}">
                                        <p id="exactmatch"></p>
                                        @if($errors->has('color_name'))
                                            <p class="text-danger mt-2">{{ $errors->first('color_name') }}</p>
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
    <!-- END Main Section-->  
    
   

@endsection
@push('script-lib')
<script src="{{asset('admin_assets/vendor/coloris/coloris.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/coloris/ntc.js')}}"></script>
<script src="{{asset('admin_assets/vendor/validateJs/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/validateJs/additional-methods.min.js')}}"></script>
<script src="{{asset('admin_assets/js/mainValidation.js')}}" defer></script>
@endpush

@push('script')
<script>
    Coloris({
        parent: '.container',
        el: 'color-field',
        wrap: true,
        theme: 'polaroid-dark',
        format: 'hex',
        clearButton: {
            show: true,
            label: 'Clear'
        },
        swatches: [
        '#FF0000',
        '#00FFFF',
        '#0000FF',
        '#800080',
        '#FFFF00',
        '#FF00FF',
        '#FFC0CB',
        '#C0C0C0',
        '#FFA500',
        ]
    })
    $('#title1').on('change', function() {
            // alert( this.value );
            var n_match  = ntc.name(this.value);
            n_rgb        = n_match[0]; // This is the RGB value of the closest matching color
            n_name       = n_match[1]; // This is the text string for the name of the match
            n_exactmatch = n_match[2]; // True if exact color match, False if close-match
            $('#title2').val(n_name);
            if (n_exactmatch==true) {
                $('#exactmatch').text("Exact Match")
            }else{
                $('#exactmatch').text("Approx Match")
            }
    });
</script>
@endpush