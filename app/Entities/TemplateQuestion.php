<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateQuestion extends Model
{
    
    const TYPE_TEXT = 'text';
    const TYPE_BOOLEAN = 'boolean';
    const TYPE_DATE = 'date';
    const TYPE_NUMBER = 'number';
    const TYPE_SELECT = 'select';
    // const TYPE_MULTISELECT = 'multiselect';
    
    const ALL_TYPES = [
        self::TYPE_TEXT => self::TYPE_TEXT,
        self::TYPE_BOOLEAN => self::TYPE_BOOLEAN,
        self::TYPE_DATE => self::TYPE_DATE,
        self::TYPE_NUMBER => self::TYPE_NUMBER,
        self::TYPE_SELECT => self::TYPE_SELECT,
        // self::TYPE_MULTISELECT => self::TYPE_MULTISELECT,
    ];
    
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
        'answer_variants' => 'array',
    ];  
    
    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }  
    
    public function setAnswerVariantsAttribute($value)
    {
        if ($this->answer_type == TemplateQuestion::TYPE_SELECT) {
            $array =  explode(',', $value);
            $this->attributes['answer_variants'] = json_encode($array);
        }
    }   
    
}
