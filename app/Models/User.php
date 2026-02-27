<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'reputation',
        'is_Ban'
    ];

    public function memberships(){
        return $this->hasMany(memberships::class);
    }

    public function colocations(){
        return $this->belongsToMany(Colocation::class, 'memberships')->withPivot('joined_at','left_at')->withTimestamps();
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'paid_by');
    }
    public function categories(){
        return $this->hasMany(Category::class , 'created_by');
    }
    public function paymentsMade()
    {
    return $this->hasMany(Payment::class, 'payer_id');
    }
    public function paymentsReceived()
    {
    return $this->hasMany(Payment::class, 'receiver_id');
    }
    public function ownedColocations(){
        return $this->hasMany(Colocation::class, 'owner_id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
