<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserArea extends Model
{
    const EARTH_RADIUS = 6371000; // Radius of Earth in meters
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'latitude', 'longitude', 'radius'
    ];
    
    /** @var array $casts */
    protected $casts = [
        'user_id' => 'integer',
    ];
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user_full_name'];    
    
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * @return string
     */
    public function getUserFullNameAttribute(): string
    {
        return $this->user->lastname . ' ' . $this->user->name;
    }             
    
}
