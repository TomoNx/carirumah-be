<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'address',
        'luas',
        'wifi_speed',
        'kapasitas',
        'harga_per_hari',
        'foto',
        'full_support',
        'tersedia_mini_cafe',
        'tersedia_gym',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
