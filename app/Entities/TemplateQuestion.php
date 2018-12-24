<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TemplateQuestion extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template_id', 'question', 'hint', 'is_required', 'answer_type', 'answer_variants'
    ];
    
    /** @var array $casts */
    protected $casts = [
        'template_id' => 'integer',
        'is_required' => 'boolean',
    ];
    
    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }    
    
}
