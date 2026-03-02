<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{ 
    
    $expenses = Expense::join('colocations', 'expenses.colocation_id','=','colocations.id')
        ->join('memberships', 'colocations.id','=','memberships.colocation_id')
        ->where('memberships.user_id', auth()->id())
        ->wherenull('memberships.left_at')
        ->select('expenses.*')
        ->distinct()
        ->latest()
        ->paginate(10);

    return view('expenses.index', compact('expenses'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

    $colocation = $user->colocations()
        ->wherePivotNull('left_at')
        ->first();
        
    $isMember = $colocation->users()
        ->where('users.id', auth()->id())
        ->wherePivotNull('left_at')
        ->exists();

    if (! $isMember) {
        abort(403);
    }

    
    $activeMembers = $colocation->memberships()
        ->whereNull('left_at')
        ->with('user')
        ->get();

    
    $categories = Category::all();

  
    $recentExpenses = $colocation->expenses()
        ->with('payer')
        ->latest()
        ->take(5)
        ->get();

   
    $sidebarColocations = $user
        ->colocations()
        ->wherePivotNull('left_at')
        ->get();

    return view('expenses.create', compact(
        'colocation',
        'activeMembers',
        'categories',
        'recentExpenses',
        'sidebarColocations'
    ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
{
    $validated = $request->validated();
    $validated['created_by'] = auth()->id();
    $colocation = auth()->user()->colocations()
        ->wherePivotNull('left_at')
        ->where('colocations.status', 'active')
        ->first();
    $validated['colocation_id'] = $colocation->id;

    $expense = Expense::create($validated);

    
    $activeMembers = $colocation->memberships()
        ->whereNull('left_at')
        ->with('user')
        ->get();

    $share = $expense->amount / $activeMembers->count(); 

    foreach ($activeMembers as $membership) {
       
        if ($membership->user_id == $expense->paid_by) {
            continue;
        }

        Payment::create([
            'colocation_id' => $colocation->id,
            'payer_id'      => $membership->user_id,  
            'receiver_id'   => $expense->paid_by,      
            'amount'        => $share,
            'status'        => 'pending',
            'expense_id'    => $expense->id,
        ]);
    }

    return redirect()->route('colocations.show', $colocation)
        ->with('success', 'Expense created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $memberships = $expense->colocation->memberships()
        ->whereNull('left_at')
        ->where('user_id', '!=', $expense->paid_by)
        ->with('user')
        ->get();
        
        $amountPerPerson = $expense->amount / ($memberships->count() + 1); 
        
        return view('expenses.show', compact('expense', 'memberships', 'amountPerPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $userId = auth()->id();
        if ($expense->paid_by !== $userId && $expense->created_by !== $userId) {
            return redirect()->route('expenses.index')->with('error', 'You can only edit expenses you have paid.');
        }
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $validated = $request->validated();
        $userId = auth()->id();
        if ($expense->paid_by !== $userId && $expense->created_by !== $userId) {
            return redirect()->route('expenses.index')->with('error', 'You can only edit expenses you have paid.');
        }
        $expense->update($validated);
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $userId = auth()->id();

        if ($expense->paid_by !== $userId && $expense->created_by !== $userId) {
            return redirect()->route('colocations.show', $expense->colocation_id)->with('error', 'You can only delete expenses you have paid.');
        }

        $expense->delete();
        return redirect()->route('colocations.show', $expense->colocation_id)->with('success', 'Expense deleted successfully.');
    }
}
