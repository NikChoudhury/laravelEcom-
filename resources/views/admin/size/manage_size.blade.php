@extends('admin.layouts.app')
@if($id>0)
    @section("title","Edit Size")
@else
    @section("title","Add Size")
@endif
@section("size_active","active")
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
                                            <a href="{{url('admin/size')}}">Size</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">{{ $id > '0' ? "Edit Size" : "Add Size"}}</li>
                                    </ul>
                                </div>
                                <h1 class="mb-2">{{ $id > '0' ? "Edit Size" : "Add Size"}}</h1>
                                <a href="{{url('admin/size')}}" class="au-btn au-btn-icon au-btn--green">Back</button></a>
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
                                <form action="{{route('size.manage_size_process')}}" method="post" name="main_form" id="main_form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="size_title" class="control-label mb-1">Size</label>
                                        <input id="size_title" name="size" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{old('size',$size)}}">
                                        @if($errors->has('size'))
                                            <p class="text-danger mt-2">{{ $errors->first('size') }}</p>
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
<script src="{{asset('admin_assets/js/jquery.validate.min.js')}}"></script>
@endpush

@push('script')
<script>
        $(function(){
            $("form[name='main_form']").validate({
                rules:{
                    size:{
                        required:true,
                        minlength:1
                    },
                    status:{
                        required:true,
                    }
                },
                messages:{
                    size: {
                        required: "Please Insert Size !!",
                        minlength: "Atleast 1 character required !!"
                    },
                    
                    status: "Please Select Category Status !!!"
                }
            });
        });
    </script>
@endpush