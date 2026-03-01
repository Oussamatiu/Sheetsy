<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use App\Models\Memberships;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $userId = auth()->id();

       $colocations = auth()->user()->colocations;

       return view('colocations.index', compact('colocations'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColocationRequest $request)
    {
       
        $hasColocation = auth()->user()
        ->memberships()
        ->whereNull('left_at')
        ->exists();

        if ($hasColocation) {
            return redirect()->route('dashboard')
                ->with('error', 'You already have an active colocation.');
        }

        
        $validated = $request->validated();
        $validated['owner_id'] = auth()->id();
        $colocation = Colocation::create($validated);

        $colocation->users()->attach($validated['owner_id'], [
            'joined_at' => now(),
        ]);
        
        return view('dashboard')->with(['Success' => 'Colocation created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
    $isOwner = $colocation->owner_id === auth()->id();
    $activeMembers = $colocation->memberships()->with('user')->whereNull('left_at')->get();
    $expensesQuery = $colocation->expenses()
    ->with(['payer', 'category']);

    if (request('month')) {
        $expensesQuery->whereMonth('expense_date', request('month'));
    }

    $expenses = $expensesQuery
        ->orderByDesc('expense_date')
        ->get();

    $totalExpenses = $colocation->expenses()->sum('amount');
    $myPaid = $colocation->expenses()->where('paid_by', auth()->id())->sum('amount');
    $perPerson = $activeMembers->count() > 0 ? $totalExpenses / $activeMembers->count() : 0;
    $myBalance = $myPaid - $perPerson;

    $pendingInvitations = $colocation->invitations()
        ->where('status', 'pending')
        ->orderByDesc('created_at')
        ->get();

    $sidebarColocations = auth()->user()->memberships()
        ->with('colocation')
        ->whereNull('left_at')
        ->get()
        ->pluck('colocation')
        ->filter();
        
    $categories = $colocation->categories()->orderBy('name')->get();

    return view('colocations.show', compact(
        'colocation',
        'isOwner',
        'activeMembers',
        'expenses',
        'totalExpenses',
        'myPaid',
        'myBalance',
        'pendingInvitations',
        'sidebarColocations',
        'categories'
    ));
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
        if ($colocation->owner_id !== Auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Only the owner can delete this colocation.');
        }

        $colocation->delete();

        return redirect()->route('dashboard')->with('success', 'Colocation deleted successfully.');
    }
    public function leave(Colocation $colocation)
    {
        $user = auth()->user();

        $membership = $colocation->users()->where('user_id', $user->id)->first();
        if($user->id === $colocation->owner_id) {
            return redirect()->route('colocations.index')->with('error', 'Owners cannot leave their colocation. Please transfer ownership or delete the colocation.');
        }
        if (!$membership) {
            abort(403);
        }

        $colocation->users()->detach($user->id);

        return redirect()->route('colocations.index')->with('success', 'You have left the colocation.');
    }
}
