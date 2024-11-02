<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
        'start_date',
        'end_date',
        'harga_per_hari',
        'total_days',
        'fee',
        'total_price',
        'status',
    ];

    public function setListingIdAttribute($value)
    {
        $listing = Listing::find($value);
        $totalDays = Carbon::CreatFromDate($this->attributes['start_date'])->diffInDays($this->attributes['end_date']) + 1;
        $totalPrice = $listing->harga_per_hari * $totalDays;
        $fee = $totalPrice * 0.1;

        $this->attributes['listing_id'] = $value;
        $this->attributes['harga_per_hari'] = $listing->harga_per_hari;
        $this->attributes['total_days'] = $totalDays;
        $this->attributes['fee'] = $fee;
        $this->attributes['total_price'] = $totalPrice; 
    }
}
