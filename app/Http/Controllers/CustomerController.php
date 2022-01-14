<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $result['data']= Customer::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/customer/customer',$result);
    }
    public function show(Request $request,$id='')
    {
        $model = Customer::where(['id'=>$id])->get();
        if ($id<0 || $model->isEmpty()) {
            $request->session()->flash('error','Data Not Found !!');
            return redirect(url('admin/customer'));
        }
        $data['customer_data']=$model['0'];
        return view('admin/customer/show_customer',$data);
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Customer::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/customer'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/customer'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/tax'));
        }
    }
}
