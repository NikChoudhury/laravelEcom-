<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
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
                $data['type']=$model['0']->type;
                $data['min_order_amt']=$model['0']->min_order_amt;
                $data['is_one_time']=$model['0']->is_one_time;

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
            $data['type']='';
            $data['min_order_amt']='';
            $data['is_one_time']='';
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
            'type'=>'required',
            'min_order_amt'=>'required',
            'is_one_time'=>'required',
            'status'=>'required'
        ],
        [
            'title.required'=>'Please Insert Coupon Title !!',
            'code.required'=>'Please Insert Coupon Code !!',
            'code.unique'=>'Coupon Code should be Unique!!',
            'value.required'=>'Please Insert Coupon Value !!',
            'type.required'=>'Please Insert Coupon Type !!',
            'min_order_amt.required'=>'Please Insert Coupon Min order Amount !!',
            'is_one_time.required'=>'Please Select !!',
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
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
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
            // $model->status = "-1";
            $model->delete();
            $request->session()->flash('message','Coupon Deleted Successfully');
            return redirect(url('admin/coupon'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/coupon'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Coupon::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/coupon'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/coupon'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/coupon'));
        }
    }
}
