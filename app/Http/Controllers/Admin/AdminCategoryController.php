<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;


class AdminCategoryController extends Controller
{
    private $destinationPathArr =[
        "category_image"=> "uploads/category",
    ];
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
                $data['parent_category_id']=$model['0']->parent_category_id;
                $data['category_image']=$model['0']->category_image;
                $data['category_status']=$model['0']->status;
                $data['is_home']=$model['0']->is_home;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/category'));
            }
           
        }else {
            $data['id']='0';
            $data['category_name']='';
            $data['category_slug']='';
            $data['parent_category_id']='';
            $data['category_image']='';
            $data['category_status']='';
            $data['is_home']='';
        }
        // Get Category Table Data
        $data['categoryData']=DB::table('categories')->where(['status'=>'1'])->where('id','!=',$id)->get();

        return view('admin/category/manage_category',$data);
    }
    
    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
            'category_image'=>'mimes:jpg,jpeg,png,jfif',
            'category_status'=>'required'
        ],
        [
            'category_name.required'=>'Please Insert Category Name !!',
            'category_slug.required'=>'Please Insert Category Slug !!',
            'category_slug.unique'=>'Category Slug should be Unique!!',
            'category_image.mimes'=>'Please Select An Valid Image',
            'category_status.required'=>'Please Select Category Status !!'
        ]);

        if ($request->post('id')>0) {
            $model = Category::find($request->post('id'));
            $msg = "Category successfully Updated ☺";
        }else {
            $model= new Category();
            $msg = "Category successfully Inserted ☺";
        }
        // Image Upload
        if ($request->hasfile('category_image')) {
            // Check Image Is Already Exist Or Not And Delete
            if ($request->post('id')>0){
                $getModel = DB::table('categories')->where(['id'=>$request->post('id')])->get();
                $path_of_the_file = "/public/".$this->destinationPathArr['category_image']."/".$getModel[0]->category_image;
                if (Storage::exists($path_of_the_file)){
                    Storage::delete($path_of_the_file);
                }
            }
            // ##################### //
            $image = $request->file('category_image');
            $ext = $image->getClientOriginalExtension();
            $image_name = getSlug($request->post('category_name')).'-'.time().'.'.$ext;
            $image->storeAs($this->destinationPathArr['category_image'], $image_name,'public');
            $model->category_image = $image_name;
        }
        // End Image Upload
        $model->category_name=$request->post('category_name');
        $model->category_slug=getSlug($request->post('category_slug'));
        $model->parent_category_id=$request->post('parent_category_id');
        $model->status=$request->post('category_status');
        $model->is_home= 0;
        if ($request->post('is_home')!==null) {
            $model->is_home= 1;
        }
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
            // $model->status = "-1";
            $getModel = DB::table('categories')->where(['id'=>$id])->get();
            $path_of_the_file = "/public/".$this->destinationPathArr['category_image']."/".$getModel[0]->category_image;
            if (Storage::exists($path_of_the_file)){
                Storage::delete($path_of_the_file);
            }
            $model->delete();
            $request->session()->flash('message','Category Deleted Successfully');
            return redirect(url('admin/category'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/category'));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Category::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/category'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/category'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/category'));
        }
    }
}
