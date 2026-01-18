<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->filter(request(['category']))->simplePaginate(5)->withQueryString();
        return view('products', compact('products'));
    }
    public function findByCategoryId($id){
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'product' => 'required|string',
        ]);
        if($validator->fails()){
            return back()->with('error', 'အချက်အလက်မှားယွင်းနေပါသည်');
        }
        try{
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->name = $request->product;
            $product->save();
            return back()->with('success', 'အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
        }catch(\Exception $e){
            return back()->with('error', 'ကုန်အမည်ထည့်သွင်းရာတွင် အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
        }
    }
}
