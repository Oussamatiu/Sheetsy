<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','owner_id', 'description' , 'token', 'status'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(memberships::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('joined_at', 'left_at')
            ->withTimestamps();
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

}
