<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title','amount','expense_date','colocation_id','created_by','paid_by','category_id'];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function payer()
    {
        return $this->belongsTo(User::class, 'paid_by');
    }

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
