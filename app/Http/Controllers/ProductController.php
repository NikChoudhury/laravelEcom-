<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductFormRequest;
use Storage;

class ProductController extends Controller
{
    private $destinationPathArr =[
        "product_image"=> "uploads/product",
        'product_images'=> "uploads/product/product-images",
        'product_attr_image' => "uploads/product/attributes-image"
    ];
    public function index()
    {
        $result['data']= Product::where('status','!=','-1')->orderBy('created_at', 'desc')->get();
        return view('admin/product/product',$result);
    }

    public function manageProduct(Request $request,$id='')
    {
        

        if ($id>0) {
            // Get Product Attribute Table Data
            $data['productAttributeData']=DB::table('product_attrs')->where(['product_id'=>$id])->get();
            // Get Product Images Table Data
            $productImagesData=DB::table('product_images')->where(['product_id'=>$id])->get();
            if (!isset($productImagesData[0])) {
                $data['productImagesData']['0']['id']='';
                $data['productImagesData']['0']['product_id']='';
                $data['productImagesData']['0']['images']='';
            }else{
                $data['productImagesData'] = $productImagesData;
            }

            $model = Product::where(['id'=>$id])->get();
            if (!$model->isEmpty()) {
                $data['id']=$model['0']->id;
                $data['category_id']=$model['0']->category_id;
                $data['name']=$model['0']->name;
                // $data['slug']=$model['0']->slug;
                $data['image']=$model['0']->image;
                $data['brand']=$model['0']->brand;
                $data['model']=$model['0']->model;
                $data['short_desc']=$model['0']->short_desc;
                $data['desc']=$model['0']->desc;
                $data['keywords']=$model['0']->keywords;
                $data['technical_specification']=$model['0']->technical_specification;
                $data['uses']=$model['0']->uses;
                $data['warranty']=$model['0']->warranty;

                $data['lead_time']=$model['0']->lead_time;
                $data['tax']=$model['0']->tax;
                $data['tax_type']=$model['0']->tax_type;
                $data['is_promo']=$model['0']->is_promo;
                $data['is_featured']=$model['0']->is_featured;
                $data['is_discounted']=$model['0']->is_discounted;
                $data['is_tranding']=$model['0']->is_tranding;

                $data['status']=$model['0']->status;
            }else {
                $request->session()->flash('error','Data Not Found !!!');
                return redirect(url('admin/product'));
            }
           
        }else {
            $data['id']='0';
            $data['category_id']="";
            $data['name']="";
            // $data['slug']="";
            $data['image']="";
            $data['brand']="";
            $data['model']="";
            $data['short_desc']="";
            $data['desc']="";
            $data['keywords']="";
            $data['technical_specification']="";
            $data['uses']="";
            $data['warranty']="";

            $data['lead_time']="";
            $data['tax']="";
            $data['tax_type']="";
            $data['is_promo']="";
            $data['is_featured']="";
            $data['is_discounted']="";
            $data['is_tranding']="";
            $data['warranty']="";

            $data['status']="";

            $data['productAttributeData'][0]['id']='';
            $data['productAttributeData'][0]['product_id']='';
            $data['productAttributeData'][0]['sku']='';
            $data['productAttributeData'][0]['attr_image']='';
            $data['productAttributeData'][0]['mrp']='';
            $data['productAttributeData'][0]['price']='';
            $data['productAttributeData'][0]['qty']='';
            $data['productAttributeData'][0]['size_id']='';
            $data['productAttributeData'][0]['color_id']='';

            $data['productImagesData'][0]['id']='';
            $data['productImagesData'][0]['product_id']='';
            $data['productImagesData'][0]['images']='';

        }
        // Get Category Table Data
        $data['categoryData']=DB::table('categories')->where(['status'=>'1'])->get();
        // Get Brand Table Data
        $data['brandData']=DB::table('brands')->where(['status'=>'1'])->get();
        // Get Size Table Data
        $data['sizeData']=DB::table('sizes')->where(['status'=>'1'])->get();
        // Get Color Table Data
        $data['colorData']=DB::table('colors')->where(['status'=>'1'])->get();
        
        return view('admin/product/manage_product',$data);
    }
    
    public function manageProductProcess(ProductFormRequest $request)
    {
        
        
        if ($request->post('id')>0) {
            $model = Product::find($request->post('id'));
            $msg = "Product successfully Updated";
        }else {
            $model= new Product();
            $msg = "Product successfully Inserted.";
        }

        // Product Attribute Part 1 Start //
        $productAttrIdArr = $request->post('product_attr_id');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('size_id');
        $color_idArr = $request->post('color_id');
        
        foreach($skuArr as $key=>$value){
            $checkUnquieSku = DB::table("product_attrs")
                                ->where('sku','=',$skuArr[$key])
                                ->where('id','!=',$productAttrIdArr[$key])
                                ->get();
            if (isset($checkUnquieSku[0])) {
                $request->session()->flash('warning', $skuArr[$key].' SKU already uesd!!!');
                return redirect(request()->headers->get('referer'))->withInput();
            }
        }
        // Product Attribute Part 1 END //

        // Image Upload
        if ($request->hasfile('image')) {
            // Check Image Is Already Exist Or Not And Delete
            if ($request->post('id')>0){
                $getModel = DB::table('products')->where(['id'=>$request->post('id')])->get();
                $path_of_the_file = "/public/".$this->destinationPathArr['product_image']."/".$getModel[0]->image;
                if (Storage::exists($path_of_the_file)){
                    Storage::delete($path_of_the_file);
                }
            }
            // ##################### //
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = getSlug($request->post('name')).'-'.time().'.'.$ext;
            $image->storeAs($this->destinationPathArr['product_image'], $image_name,'public');
            $model->image = $image_name;
        }
        // End Image Upload

        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=getSlug($request->post('name'));
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');

        $model->lead_time=$request->post('lead_time');
        $model->tax=$request->post('tax');
        $model->tax_type=$request->post('tax_type');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');

        $model->status=$request->post('status');

        $isModelSaved = $model->save();
        $productID =$model->id;

        // Product Images Start
        $product_images_id_arry = $request->post('product_images_id');
        foreach ($product_images_id_arry as $key => $value) {
            $productImagesArr = [];
            $productImagesArr['product_id'] = $productID;
            if ($request->hasfile("images.$key")) {
                if ($product_images_id_arry[$key]!=''){
                    $getModel = DB::table('product_images')->where(['id'=>$product_images_id_arry[$key]])->get();
                    $path_of_the_file = "/public/".$this->destinationPathArr['product_images']."/".$getModel[0]->images;
                    if (Storage::exists($path_of_the_file)){
                        Storage::delete($path_of_the_file);
                    }
                }
                // ##################### //
                $randomNumber = rand('1111111','999999999');
                $images = $request->file("images.$key");
                $ext = $images->getClientOriginalExtension();
                $images_name = getSlug($request->post('name')).'-'.time().'-'.$randomNumber.'.'.$ext;
                $images->storeAs($this->destinationPathArr['product_images'], $images_name,'public');
                $productImagesArr['images'] = $images_name;

                if ($product_images_id_arry[$key]!='') {
                    DB::table('product_images')->where(['id'=>$product_images_id_arry[$key]])->update($productImagesArr);   
                }else {
                    DB::table('product_images')->insert($productImagesArr);   
                }
            }
            
           
        }
        // Product Images END

        // Product Attribute Part 2 Start //
        foreach ($skuArr as $key => $value) {
            $productAttrArr = [];
            $productAttrArr['product_id'] = $productID;
            $productAttrArr['sku'] = $skuArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            $productAttrArr['size_id'] = $size_idArr[$key];
            $productAttrArr['color_id'] = $color_idArr[$key];

            // Product Attr Image Upload
            if ($request->hasfile("attr_image.$key")) {
                 // Check Image Is Already Exist Or Not And Delete
                if ($productAttrIdArr[$key]!=''){
                    $getModel = DB::table('product_attrs')->where(['id'=>$productAttrIdArr[$key]])->get();
                    $path_of_the_file = "/public/".$this->destinationPathArr['product_attr_image']."/".$getModel[0]->attr_image;
                    if (Storage::exists($path_of_the_file)){
                        Storage::delete($path_of_the_file);
                    }
                }
                // ##################### //
                $randomNumber = rand('1111111','999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->getClientOriginalExtension();
                $attr_image_name = getSlug($request->post('name')).'-'.time().'-'.$randomNumber.'.'.$ext;
                $attr_image->storeAs($this->destinationPathArr['product_attr_image'], $attr_image_name,'public');
                $productAttrArr['attr_image'] = $attr_image_name;
            }
            // Product Attr Image Upload END
            if ($productAttrIdArr[$key]!='') {
                DB::table('product_attrs')->where(['id'=>$productAttrIdArr[$key]])->update($productAttrArr);   
            }else {
                DB::table('product_attrs')->insert($productAttrArr);   
            }
        }
        // Product Attribute Part 2 END //
        if ($isModelSaved) {
            $request->session()->flash('message',$msg);
            return redirect(url('admin/product'));
        }else{
            return withInput();
        }
                
    }

    public function removeProduct(Request $request,$id)
    {
        $model= Product::where('status','!=','-1')->find($id);
        if ($model) {
            $getModel = DB::table('products')->where(['id'=>$id])->get();
            $path_of_the_file = "/public/".$this->destinationPathArr['product_image']."/".$getModel[0]->image;
            if (Storage::exists($path_of_the_file)){
                Storage::delete($path_of_the_file);
            }
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/product'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product'));
        }
    }

    public function removeProductAttr(Request $request,$product_attr_id,$product_id)
    {
        $model= DB::table('product_attrs')->where(['id'=>$product_attr_id]);
        if ($model) {
            $getModel = $model->get();
            $path_of_the_file = "/public/".$this->destinationPathArr['product_attr_image']."/".$getModel[0]->attr_image;
            if (Storage::exists($path_of_the_file)){
                Storage::delete($path_of_the_file);
            }
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/product/manage_product/'.$product_id));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product/manage_product/'.$product_id));
        }
    }

    public function removeProductImages(Request $request,$product_images_id,$product_id)
    {
        $model= DB::table('product_images')->where(['id'=>$product_images_id]);
        if ($model) {
            $getModel = $model->get();
            $path_of_the_file = "/public/".$this->destinationPathArr['product_images']."/".$getModel[0]->images;
            if (Storage::exists($path_of_the_file)){
                Storage::delete($path_of_the_file);
            }
            $model->delete();
            $request->session()->flash('message',"Deleted Successfully");
            return redirect(url('admin/product/manage_product/'.$product_id));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product/manage_product/'.$product_id));
        }
    }

    public function changeStatus(Request $request,$status,$id)
    {
        $model= Product::where('status','!=','-1')->find($id);
        if ($model) {
            $status= $request->status;
            if ($status=="deactive") {
                $model->status = "1";
            }elseif ($status=="active") {
                $model->status = "0";
            }else {
                $request->session()->flash('error','Something Went Wrong !!!');
                return redirect(url('admin/product'));
            }
            $model->save();
            $request->session()->flash('message','Status Updated !!');
            return redirect(url('admin/product'));
        }else{
            $request->session()->flash('error','Data Not Found !!!');
            return redirect(url('admin/product'));
        }
    }
}
