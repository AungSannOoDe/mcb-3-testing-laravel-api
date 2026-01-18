<?php

namespace App\Http\Controllers;

use App\Models\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gates = Gate::latest()->simplePaginate(5);
        return view('gates', compact('gates'));
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
            'gate' => 'required|string',
        ]);
        if($validator->fails()){
            return back()->with('error', 'အချက်အလက်မှားယွင်းနေပါသည်');
        }
        try{
            $gate = new Gate();
            $gate->name = $request->gate;
            $gate->save();
            return back()->with('success', 'အောင်မြင်စွာ ထည့်သွင်းပြီးပါပြီ။');
        }catch(\Exception $e){
            return back()->with('error', 'ဂိတ်အမည်ထည့်သွင်းရာတွင် အမှားအယွင်းတစ်ခု ဖြစ်နေပါသည်။');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gate $gate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gate $gate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gate $gate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gate $gate)
    {
        //
    }
}
