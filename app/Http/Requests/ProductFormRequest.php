<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\DB;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Image Validation Status
        if ($this->post('id')>0) {
            $image_validation = 'mimes:jpg,jpeg,png';
        }else {
            $image_validation = 'required|mimes:jpg,jpeg,png';
        }
        // End Image Validation Status
        return [
            'category_id'=>'required',
            'name'=>"required|unique:products,name,{$this->post('id')}",
            'image'=>$image_validation,
            'tax_id'=>'required',
            'is_promo'=>'required',
            'is_featured'=>'required',
            'is_discounted'=>'required',
            'is_tranding'=>'required',
            'status'=>'required',
            
            // 'sku.*'=>['required',new isUniqueSku(['sku.*'])]
            'sku.*'=>['required'],
            'mrp.*'=>['required','numeric','gt:0'],
            'price.*'=>['required','numeric','gt:0'],
            'qty.*'=>['required','integer','gte:0'],
            'attr_image.*'=>['mimes:jpg,jpeg,png'],
            'images.*'=>['mimes:jpg,jpeg,png'],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required'=>'Please Select Category !!',
            'name.required'=>'Please Insert Product Name !!',
            'name.unique'=>'Name should be Unique!!',
            'status.required'=>'Please Select Status !!',
            'sku.*.required'=>'Please Insert SKU',
            'mrp.*.required'=>'Please Insert MRP',
            'mrp.*.numeric'=>'Please Insert valid Input',
            'mrp.*.gt'=>'The MRP must be greater than 0',
            'price.*.required'=>'Please Insert Price',
            'price.*.numeric'=>'Please Insert valid Input',
            'price.*.gt'=>'The Price must be greater than 0',
            'qty.*.required'=>'Please Insert Quantity',
            'qty.*.integer'=>'Please Insert valid Input',
            'qty.*.gte'=>'The Quantity must be greater than Or equal 0',
            'attr_image.*.mimes'=> "Please Select An Valid Image",  
            'images.*.mimes'=> "Please Select An Valid Image",  
            'tax_id.required'=>'Please Select Tax !!',

        ];
    }
}
