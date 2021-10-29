<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $result['data']= Product::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/product/product',$result);
    }

    public function manageProduct(Request $request,$id='')
    {
        if ($id>0) {
            $model = Product::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['category_id']=$model['0']->category_id;
                $data['name']=$model['0']->name;
                // $data['slug']=$model['0']->slug;
                $data['image']=$model['0']->image;
                $data['brand']=$model['0']->brand;
                $data['model']=$model['0']->model;
                $data['short_desc']=$model['0']->short_desc;
                $data['desc']=$model['0']->desc;
                $data['keywords']=$model['0']->keywords;
                $data['technical_specification']=$model['0']->technical_specification;
                $data['uses']=$model['0']->uses;
                $data['warranty']=$model['0']->warranty;
                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/product'));
            }
           
        }else {
            $data['id']='0';
            $data['category_id']="";
            $data['name']="";
            // $data['slug']="";
            $data['image']="";
            $data['brand']="";
            $data['model']="";
            $data['short_desc']="";
            $data['desc']="";
            $data['keywords']="";
            $data['technical_specification']="";
            $data['uses']="";
            $data['warranty']="";
            $data['status']="";
        }
        // Get Category Table Data
        $data['categoryData']=DB::table('categories')->where(['status'=>'1'])->get();
        // Get Brand Table Data
        $data['brandData']=DB::table('brands')->where(['status'=>'1'])->get();
        
        return view('admin/product/manage_product',$data);
    }
    
    public function manageProductProcess(Request $request)
    {
        // Image Validation Status
        if ($request->post('id')>0) {
            $image_validation = 'mimes:jpg,jpeg,png';
        }else {
            $image_validation = 'required|mimes:jpg,jpeg,png';
        }
        // End Image Validation Status

        $request->validate([
            'category_id'=>'required',
            'name'=>'required|unique:products,slug,'.$request->post('id'),
            'image'=>$image_validation,
            'status'=>'required'
        ],
        [
            'category_id.required'=>'Please Select Category !!',
            'name.required'=>'Please Insert Product Name  !!',
            'name.unique'=>'Name should be Unique!!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);
        
        if ($request->post('id')>0) {
            $model = Product::find($request->post('id'));
            $msg = "Product successfully Updated";
        }else {
            $model= new Product();
            $msg = "Product successfully Inserted.";
        }

        // Image Upload
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = getSlug($request->post('name')).'-'.time().'.'.$ext;
            $destinationPath = 'uploads/product';
            $image->storeAs($destinationPath, $image_name,'public');
            $model->image = $image_name;
        }
        // End Image Upload
        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=getSlug($request->post('name'));
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->status=$request->post('status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/product'));
        }else{
            return withInput();
        }
                
    }

    public function removeProduct(Request $request,$id)
    {
        $model= Product::where('status','!=','-1')->find($id);
        if ($model) {
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/product'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Product::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/product'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/product'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product'));
        }
    }
}
