<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data']= Color::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/color/color',$result);
    }

    public function manageColor(Request $request,$id='')
    {
        if ($id>0) {
            $model = Color::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['color_name']=$model['0']->color_name;
                $data['color_code']=$model['0']->color_code;
                $data['color_details']=$model['0']->color_details;
                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/color'));
            }
           
        }else {
            $data['id']='0';
            $data['color_name']='';
            $data['color_code']='';
            $data['color_details']='';
            $data['status']='';
        }
        return view('admin/color/manage_color',$data);
    }
    
    public function manageColorProcess(Request $request)
    {
        $request->validate([
            'color_name'=>'required|unique:colors,color_name,'.$request->post('id'),
            'color_code'=>['required','regex: /^#[0-9a-fA-F]{8}$|#[0-9a-fA-F]{6}$|#[0-9a-fA-F]{4}$|#[0-9a-fA-F]{3}$/','unique:colors,color_code,'.$request->post('id')],
            'status'=>'required'
        ],
        [
            'color_name.required'=>'Please Insert Color Name  !!',
            'color_name.unique'=>'Color name should be Unique!!',
            'color_code.required'=>'Please Insert Color Code  !!',
            'color_code.unique'=>'Color Code should be Unique!!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Color::find($request->post('id'));
            $msg = "Color successfully Updated ☺";
        }else {
            $model= new Color();
            $msg = "Color successfully Inserted ☺";
        }
        
        $model->color_name=$request->post('color_name');
        $model->color_code=$request->post('color_code');
        $model->status=$request->post('status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/color'));
        }else{
            return withInput();
        }
                
    }

    public function removeColor(Request $request,$id)
    {
        $model= Color::where('status','!=','-1')->find($id);
        // $model = Category::find($id);
        if ($model) {
            $model->delete();
            $request->session()->flash('message','Deleted Successfully');
            return redirect(url('admin/color'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/color'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Color::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/color'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/color'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/color'));
        }
    }
}
