<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the products.
     */
    protected $appends = [
        'highest_bid_price'
    ];
    public function seller()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getHighestBidPriceAttribute(){
        return  12.00;
    }

    public function activebids()
    {
       
    }

    public function user___()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function getUser_()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id')
            ->select(['user_id', 'name', 'user_type']);
    }

    /**
     * Get the photos for the blog post.
     */
    public function productimages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];
}
