<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;


    

class DashboardController extends Controller
{
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

        return view('dashboard', compact(
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
}
