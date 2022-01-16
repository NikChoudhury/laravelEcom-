<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']= Test::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/test/test',$result);
    }

    public function removeTax(Request $request,$id)
    {
        $model= Test::where('status','!=','-1')->find($id);
        if ($model) {
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/test'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/test'));
        }
    }

}
