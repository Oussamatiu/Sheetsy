<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['colocation_id','payer_id','receiver_id','amount','paid_at','status','expense_id'];

    protected $casts = [
      'paid_at' => 'datetime',
    ];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}

