<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data']= Tax::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/tax/tax',$result);
    }

    public function manageTax(Request $request,$id='')
    {
        if ($id>0) {
            $model = Tax::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['tax_desc']=$model['0']->tax_desc;
                $data['tax_value']=$model['0']->tax_value;
                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/tax'));
            }
           
        }else {
            $data['id']='0';
            $data['tax_desc']='';
            $data['tax_value']='';
            $data['status']='';
        }
        return view('admin/tax/manage_tax',$data);
    }
    
    public function manageTaxProcess(Request $request)
    {
        $request->validate([
            'tax_value'=>'required|unique:taxes,tax_value,'.$request->post('id'),
            'tax_desc'=>'required',
            'status'=>'required',
        ],
        [
            'tax_value.required'=>'Please Insert Tax Value !!',
            'tax_value.unique'=>'Tax Value should be Unique!!',
            'tax_desc.required'=>'Please Insert Tax Decription !!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Tax::find($request->post('id'));
            $msg = "Tax successfully Updated";
        }else {
            $model= new Tax();
            $msg = "Tax successfully Inserted.";
        }
        
        $model->tax_desc=$request->post('tax_desc');
        $model->tax_value=$request->post('tax_value');
        $model->status=$request->post('status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/tax'));
        }else{
            return withInput();
        }
                
    }

    public function removeTax(Request $request,$id)
    {
        $model= Tax::where('status','!=','-1')->find($id);
        if ($model) {
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/tax'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/tax'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Tax::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/tax'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/tax'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/tax'));
        }
    }
}
