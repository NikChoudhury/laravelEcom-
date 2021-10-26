<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data']= Size::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/size/size',$result);
    }

    public function manageSize(Request $request,$id='')
    {
        if ($id>0) {
            $model = Size::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['size']=$model['0']->size;
                $data['size_details']=$model['0']->size_details;
                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/size'));
            }
           
        }else {
            $data['id']='0';
            $data['size']='';
            $data['size_details']='';
            $data['status']='';
        }
        return view('admin/size/manage_size',$data);
    }
    
    public function manageSizeProcess(Request $request)
    {
        // return $request->post();
        // die();
        $request->validate([
            'size'=>'required|unique:sizes,size,'.$request->post('id'),
            'status'=>'required'
        ],
        [
            'size.required'=>'Please Insert Size  !!',
            'size.unique'=>'Size should be Unique!!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Size::find($request->post('id'));
            $msg = "Size successfully Updated ☺";
        }else {
            $model= new Size();
            $msg = "Size successfully Inserted ☺";
        }
        
        $model->size=$request->post('size');
        $model->status=$request->post('status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/size'));
        }else{
            return withInput();
        }
                
    }

    public function removeSize(Request $request,$id)
    {
        $model= Size::where('status','!=','-1')->find($id);
        // $model = Category::find($id);
        if ($model) {
            $model->delete();
            $request->session()->flash('message','Deleted Successfully');
            return redirect(url('admin/size'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/size'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Size::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/size'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/size'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/size'));
        }
    }
}
