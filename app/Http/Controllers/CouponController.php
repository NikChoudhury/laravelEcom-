<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']= Coupon::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/coupon/coupon',$result);
    }

    public function manageCoupon(Request $request,$id='')
    {
        if ($id>0) {
            $model = Coupon::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['title']=$model['0']->title;
                $data['code']=$model['0']->code;
                $data['value']=$model['0']->value;
                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/coupon'));
            }
           
        }else {
            $data['id']='0';
            $data['title']='';
            $data['code']='';
            $data['value']='';
            $data['status']='';
        }
        return view('admin/coupon/manage_coupon',$data);
    }
    
    public function manageCouponProcess(Request $request)
    {
        // return $request->post();
        // die();
        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code,'.$request->post('id'),
            'value'=>'required',
            'status'=>'required'
        ],
        [
            'title.required'=>'Please Insert Coupon Title !!',
            'code.required'=>'Please Insert Coupon Code !!',
            'code.unique'=>'Coupon Code should be Unique!!',
            'value.required'=>'Please Insert Coupon Value !!',
            'status.required'=>'Please Select Coupan Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon successfully Updated ☺";
        }else {
            $model= new Coupon();
            $msg = "Coupon successfully Inserted ☺";
        }
        
        $model->title=$request->post('title');
        $model->code=$request->post('code');
        $model->value=$request->post('value');
        $model->status=$request->post('status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/coupon'));
        }else{
            return withInput();
        }
                
    }

    public function removeCoupon(Request $request,$id)
    {
        $model= Coupon::where('status','!=','-1')->find($id);
        // $model = Category::find($id);
        if ($model) {
            $model->status = "-1";
            $model->delete();
            $request->session()->flash('message','Coupon Deleted Successfully');
            return redirect(url('admin/coupon'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/coupon'));
        }
    }
}
