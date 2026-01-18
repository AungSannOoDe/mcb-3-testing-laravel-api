<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shops = Shop::latest()->simplePaginate(5);
        return view('shops', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop' => 'required|string',
        ]);
        if($validator->fails()){
            return back()->with('error', 'အချက်အလက်မှားယွင်းနေပါသည်');
        }
        try{
            $shop = new Shop();
            $shop->name = $request->shop;
            $shop->save();
            return back()->with('success', 'အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
        }catch(\Exception $e){
            return back()->with('error', 'လွှဲပြောင်းဆိုင်အမည်ထည့်သွင်းရာတွင် အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
