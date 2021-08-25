<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use phpDocumentor\Reflection\Types\Boolean;
use Musonza\Chat\Traits\Messageable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Messageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /// eg git 


    /**
     * Get the products for the user.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function complainLoged()
    {
        return $this->hasMany(Complaint::class,'loged_by');
    }


    public static function annualFeeExpire($userId)
    {
        $user = User::where('id', '=', $userId)->first();
        $today = date("Y-m-d H:m:s");
        $expire =$user->annual_fee_paid;
        $today_time = strtotime($today);
        $expire_time = strtotime($expire);

        return ($today_time < $expire_time);


    }
}
