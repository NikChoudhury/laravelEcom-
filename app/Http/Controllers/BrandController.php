<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
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
        if ($request->file('brand_logo')) {
            $fileName = time().'-'.$request->brand_logo->getClientOriginalName();
            $request->file('brand_logo')->storeAs('uploads/brand', $fileName, 'public');
            $model->brand_logo = $fileName;
        }
        $model->status=$request->post('status');
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
