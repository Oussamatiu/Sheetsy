<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use App\Models\Memberships;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColocationRequest $request)
    {
        $id = auth()->id();
        $find = Memberships::where('user_id', $id)->first();

        if($find) {
            return view('colocations.create')->with(['Error' => 'You already have a colocation.']);
        }
        $request->merge(['owner_id' => $id]);
        $validated = $request->validated();

        Colocation::create($validated)->attach($validated['owner_id'], [
            'role' => 'owner',
            'joined_at' => now(),
        ]);
        
        return view('colocations.create')->with(['Success' => 'Colocation created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colocation $colocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        //
    }
}
