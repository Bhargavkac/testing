<?php

namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
Use Validator;
use Carbon\Carbon;

class ProductController extends Controller
{ 
    public function AllProducts() {
    	$products = Product::with('Tag')->get();  
        return view('all_products',compact('products'));
    }

    public function AddProduct() {
        return view('add_product');
    }

    public function StoreProduct(Request $request) { 

    	$validated = $request->validate([
	        'name' => 'required',
		    'date' => 'required',
		    'stock' => 'required',
	    ]); 

    	$product = new Product();
    	$product->name  = $request->name;
    	$product->date  = Carbon::createFromFormat('d-m-Y H:i:s', $request->date)->format('Y-m-d H:i:s');
    	$product->stock = $request->stock; 
    	$product->save();

    	$all_tags = explode(',', $request->tags); 
    	if(count($all_tags) > 0){
    		foreach ($all_tags as $key => $value) {
    			$product_tags = new Tag();
		    	$product_tags->product_id  = $product->id; 
		    	$product_tags->tag = $value; 
		    	$product_tags->save();
    		}
    	} 
    	return redirect()->route('all.products')->with('message', 'Product added successfully!');
    }

    public function EditProduct($product_id) { 
    	$product = Product::with('Tag')->where('id',$product_id)->first();
    	$all_tags = []; 
    	foreach ($product['Tag'] as $key => $value) {
    		$all_tags[] = $value->tag; 
    	} 
		$tags = implode(', ', $all_tags);   
        return view('edit_product',compact('product','tags'));
    }

    public function UpdateProduct(Request $request,$product_id) {   	

		$validated = $request->validate([
	        'name' => 'required',
		    'date' => 'required',
		    'stock' => 'required',
	    ]);

    	$product = Product::where('id',$product_id)->update([
    		'name'  => $request->name,
	    	'date'  => Carbon::createFromFormat('d-m-Y H:i:s', $request->date)->format('Y-m-d H:i:s'),
	    	'stock' => $request->stock,
    	]); 

    	$all_tags = explode(',', $request->tags); 
    	if(count($all_tags) > 0){
    		Tag::where('product_id',$product_id)->delete();
    		foreach ($all_tags as $key => $value) {
    			$product_tags = new Tag();
		    	$product_tags->product_id  = $product_id; 
		    	$product_tags->tag = $value; 
		    	$product_tags->save();
    		}
    	} 
    	return redirect()->route('all.products')->with('message', 'Product updated successfully!');
    }

    public function DeleteProduct(Request $request) { 
		Product::where('id',$request->product_id)->delete();
    	Tag::where('product_id',$request->product_id)->delete(); 
    	return 1;
    }

    public function ProductListing(Request $request) { 
    	$products = Product::with('Tag')->orderby('stock','ASC')->take(3)->get(); 
		return view('product_listing',compact('products'));
    }

    
} 
 