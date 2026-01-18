<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->simplePaginate(5);
        return view('categories', compact('categories'));
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
            'category' => 'required|string',
        ]);
        if($validator->fails()){
            return back()->with('error', 'အချက်အလက်မှားယွင်းနေပါသည်');
        }
        try{
            $category = new Category;
            $category->name = $request->category;
            $category->save();
            return back()->with('success', 'အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
        }catch(\Exception $e){
            return back()->with('error', 'ကုန်အမျိုးအစားထည့်သွင်းရာတွင် အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
