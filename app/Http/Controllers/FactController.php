<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SourceArea;
use App\Models\Gate;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;

class FactController extends Controller
{
    
    public function showFactForms(){
        $categories = Category::latest()->get();
        return view('addFacts', compact('categories'));
    }
    public function edit($id){
        $type = request()->type;
        if($type == "category"){
            $category = Category::find($id);
            $category->update(['name' => request()->name]);
            return redirect('/categories');
        }
        elseif($type == "sourcearea"){
            $area = SourceArea::find($id);
            $area->update(['name' => request()->name]);
            return redirect('/sourceareas');
        }elseif($type == "gate"){
            $gate = Gate::find($id);
            $gate->update(['name' => request()->name]);
            return redirect('/gates');
        }elseif($type == "shop"){
            $shop = Shop::find($id);
            $shop->update(['name' => request()->name]);
            return redirect('/shops');
        }elseif($type == "product"){
            $product = Product::find($id);
            $product->update(['name' => request()->name]);
            return redirect('/products');
        }
    }
    public function delete($id){
        $type = request()->type;
        
        if($type == "sourcearea"){
            $area = SourceArea::find($id);
           try{
                $area->delete();
                return redirect('/sourceareas');
           }catch(\Exception $e){
                return redirect('/sourceareas')->with('error', 'ဤအချက်လက်နှင့်ဆိုင်သောတင်ပို့ကုန်စာရင်းများရှိနေပါသဖြင့် ဖျက်၍မရပါ။');
           }
        }elseif($type == "gate"){
            $gate = Gate::find($id);
            try{
                $gate->delete();
                return redirect('/gates');
           }catch(\Exception $e){
                return redirect('/gates')->with('error', 'ဤအချက်လက်နှင့်ဆိုင်သောတင်ပို့ကုန်စာရင်းများရှိနေပါသဖြင့် ဖျက်၍မရပါ။');
           }
        }elseif($type == "shop"){
            $shop = Shop::find($id);
            try{
                $shop->delete();
                return redirect('/shops');
           }catch(\Exception $e){
                return redirect('/shops')->with('error', 'ဤအချက်လက်နှင့်ဆိုင်သောတင်ပို့ကုန်စာရင်းများရှိနေပါသဖြင့် ဖျက်၍မရပါ။');
           }
        }elseif($type == "product"){
            $product = Product::find($id);
            try{
                $product->delete();
                return redirect('/products');
           }catch(\Exception $e){
                return redirect('/products')->with('error', 'ဤအချက်လက်နှင့်ဆိုင်သောတင်ပို့ကုန်စာရင်းများရှိနေပါသဖြင့် ဖျက်၍မရပါ။');
           }
        }elseif($type == "order"){
            $order = Order::find($id);
            try{
                $order->delete();
                return redirect('/orders');
           }catch(\Exception $e){
                return redirect('/products')->with('error', 'အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
           }
        }
    }
}