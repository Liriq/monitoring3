<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportAnswer extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id', 'question', 'hint', 'is_required', 'answer_type', 'answer_variants', 'answer',
    ];
    
    /** @var array $casts */
    protected $casts = [
        'report_id' => 'integer',
        'is_required' => 'boolean',
    ];
    
    /** @var array $dates */
    protected $dates = [
        'published_at',
    ];
    
    /**
     * @return BelongsTo
     */    
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }
    
}
