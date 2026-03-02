<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function markPaid(Colocation $colocation, Payment $payment)
    {
        
        if ($payment->receiver_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to mark this payment as paid.');
        }

        
        if ($payment->colocation_id !== $colocation->id) {
            return back()->with('error', 'Payment does not belong to this colocation.');
        }

        $payment->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        

        return back()->with('success', 'Payment marked as paid successfully!');
    }
}
