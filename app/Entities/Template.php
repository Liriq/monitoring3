<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(TemplateQuestion::class);
    }
    
    /**
     * @return HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
        
}
