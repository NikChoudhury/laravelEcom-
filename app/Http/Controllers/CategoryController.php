<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']= Category::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/category/category',$result);
    }

    public function manageCategory(Request $request,$id='')
    {
        if ($id>0) {
            $model = Category::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['category_name']=$model['0']->category_name;
                $data['category_slug']=$model['0']->category_slug;
                $data['category_status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/category'));
            }
           
        }else {
            $data['id']='0';
            $data['category_name']='';
            $data['category_slug']='';
            $data['category_status']='';
        }
        return view('admin/category/manage_category',$data);
    }
    
    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
            'category_status'=>'required'
        ],
        [
            'category_name.required'=>'Please Insert Category Name !!',
            'category_slug.required'=>'Please Insert Category Slug !!',
            'category_slug.unique'=>'Category Slug should be Unique!!',
            'category_status.required'=>'Please Select Category Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Category::find($request->post('id'));
            $msg = "Category successfully Updated ☺";
        }else {
            $model= new Category();
            $msg = "Category successfully Inserted ☺";
        }
        
        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');
        $model->status=$request->post('category_status');
        if ($model->save()) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/category'));
        }else{
            return withInput();
        }
                
    }

    public function removeCategory(Request $request,$id)
    {
        $model= Category::where('status','!=','-1')->find($id);
        // $model = Category::find($id);
        if ($model) {
            $model->status = "-1";
            $model->delete();
            $request->session()->flash('message','Category Deleted Successfully');
            return redirect(url('admin/category'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/category'));
        }
    }
}
