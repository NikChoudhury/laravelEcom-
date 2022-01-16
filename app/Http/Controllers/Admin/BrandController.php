<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class BrandController extends Controller
{
    public function index()
    {
        $result['data']= Brand::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/brand/brand',$result);
    }

    public function manageBrand(Request $request,$id='')
    {
        if ($id>0) {
            $model = Brand::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['brand_name']=$model['0']->brand_name;
                $data['brand_description']=$model['0']->brand_description;
                $data['brand_website']=$model['0']->brand_website;
                $data['brand_logo']=$model['0']->brand_logo;
                $data['status']=$model['0']->status;
                $data['is_home']=$model['0']->is_home;
                // $data['brand_warranty_details']=$model['0']->brand_warranty_details;
                // $data['brand_contact_info']=$model['0']->brand_contact_info;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/brand'));
            }
           
        }else {
            $data['id']='0';
            $data['brand_name']='';
            $data['brand_description']='';
            $data['brand_website']='';
            $data['brand_logo']='';
            $data['status']='';
            $data['is_home']='';
            // $data['brand_warranty_details']='';
            // $data['brand_contact_info']='';
        }
        return view('admin/brand/manage_brand',$data);
    }
    
    public function manageBrandProcess(Request $request)
    {
        $request->validate([
            'brand_name'=>'required|unique:brands,brand_name,'.$request->post('id'),
            'brand_logo'=>'mimes:jpg,jpeg,png|max:1024',
            'status'=>'required'
        ],
        [
            'brand_name.required'=>'Please Insert Brand Name  !!',
            'brand_name.unique'=>'Brand name should be Unique!!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Brand::find($request->post('id'));
            $msg = "Brand successfully Updated";
        }else {
            $model= new Brand();
            $msg = "Brand successfully Inserted.";
        }
        
        $model->brand_name=$request->post('brand_name');
        $model->brand_description=$request->post('brand_description');
        $model->brand_website=$request->post('brand_website');
        # Upload File with a New name
        if ($request->hasfile('brand_logo')) {
             // Check Image Is Already Exist Or Not And Delete
            if ($request->post('id')>0){
                $getModel = DB::table('brands')->where(['id'=>$request->post('id')])->get();
                $path_of_the_file = "/public/uploads/brand/".$getModel[0]->brand_logo;
                if (Storage::exists($path_of_the_file)){
                    Storage::delete($path_of_the_file);
                }
            }
            // ##################### //
            $image = $request->file('brand_logo');
            $ext = $image->getClientOriginalExtension();
            $image_name = getSlug($request->post('brand_name')).'-logo'.'-'.time().'.'.$ext;
            $image->storeAs('uploads/brand', $image_name,'public');
            $model->brand_logo = $image_name;
        }
        $model->status=$request->post('status');
        $model->is_home = 0;
        if ($request->post('is_home')!==null) {
            $model->is_home = 1;
        }
        // $model->brand_warranty_details=$request->post('brand_warranty_details');
        // $model->brand_contact_info=$request->post('brand_contact_info');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/brand'));
        }else{
            return withInput();
        }
                
    }

    public function removeBrand(Request $request,$id)
    {
        $model= Brand::where('status','!=','-1')->find($id);
        if ($model) {
            $getModel = DB::table('brands')->where(['id'=>$id])->get();
            $path_of_the_file = "/public/uploads/brand/".$getModel[0]->brand_logo;
            if (Storage::exists($path_of_the_file)){
                Storage::delete($path_of_the_file);
            }
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/brand'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/brand'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Brand::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/brand'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/brand'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/brand'));
        }
    }
}
