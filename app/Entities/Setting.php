<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const REPORT_DEADLINE = 'report_deadline';
    
    const ALL_NAMES = [
        self::REPORT_DEADLINE => self::REPORT_DEADLINE,
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value', 'description',
    ];
        
}
