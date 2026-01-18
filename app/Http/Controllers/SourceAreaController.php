<?php

namespace App\Http\Controllers;

use App\Models\SourceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SourceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = SourceArea::latest()->simplePaginate(5);
        return view('sourceareas', compact('areas'));
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
            'sourceArea' => 'required|string',
        ]);
        if($validator->fails()){
            return back()->with('error', 'အချက်အလက်မှားယွင်းနေပါသည်');
        }
        try{
            $sourceArea = new SourceArea();
            $sourceArea->name = $request->sourceArea;
            $sourceArea->save();
            return back()->with('success', 'အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
        }catch(\Exception $e){
            return back()->with('error', 'ပွဲရုံအမည်ထည့်သွင်းရာတွင် အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SourceArea $sourceArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SourceArea $sourceArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SourceArea $sourceArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SourceArea $sourceArea)
    {
        //
    }
}
