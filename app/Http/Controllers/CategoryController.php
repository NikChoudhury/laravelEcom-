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

    public function manageCategory()
    {
        return view('admin/category/manage_category');
    }
    
    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories',
            'category_status'=>'required'
        ],
        [
            'category_name.required'=>'Please Insert Category Name !!',
            'category_slug.required'=>'Please Insert Category Slug !!',
            'category_slug.unique'=>'Category Slug should be Unique!!',
            'category_status.required'=>'Please Select Category Status !!'
        ]);

        $model= new Category();
        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');
        $model->status=$request->post('category_status');
        if ($model->save()) {
            $request->session()->flash('message','Category successfully Inserted ☺');
            return redirect(url('admin/category/manage_category'));
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
