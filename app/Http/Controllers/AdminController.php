<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = auth()->user();
        $users = \App\Models\User::all();

        
        $allMemberships = $user->memberships()
            ->with(['colocation' => function($query) {
                $query->withCount('memberships');
            }])
            ->latest()
            ->get();

       
        $totalColocs = $allMemberships->count();
        
        $activeMembership = $allMemberships->whereNull('left_at')->first();
        $activeColoc = $activeMembership ? $activeMembership->colocation : null;
        
        $ownedCount = $allMemberships->filter(function ($membership) use ($user) {
            return $membership->colocation->owner_id === $user->id;
        })->count();
        
        
        
        $reputation = $user->reputation_score ?? 0;
        $reputationLabel = $this->getReputationLabel($reputation);
        $reputationClass = $reputation >= 0 ? 'green' : 'red';

        return view('admin.index', compact(
            'user',
            'allMemberships',
            'totalColocs',
            'activeColoc',
            'ownedCount',
            'reputation',
            'reputationLabel',
            'reputationClass',
            'users'
        ));
    }
 private function getReputationLabel($score)
    {
        if ($score >= 3) return 'Excellent behavior';
        if ($score >= 1) return 'Good standing';
        if ($score == 0) return 'Neutral';
        return 'Poor — pay your debts';
    }
    public function toggleBan($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->is_Ban = !$user->is_Ban;
        $user->update();

        return redirect()->route('admin.index')->with('success', 'User ' . ($user->is_Ban ? 'banned' : 'unbanned') . ' successfully.');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
