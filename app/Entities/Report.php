<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'template_id', 'name', 'published_at'
    ];
    
    /** @var array $casts */
    protected $casts = [
        'user_id' => 'integer',
        'template_id' => 'integer',
    ];
    
    /** @var array $dates */
    protected $dates = [
        'published_at',
    ];

    /**
     * @return BelongsTo
     */    
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * @return BelongsTo
     */    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */    
    public function answers(): HasMany
    {
        return $this->hasMany(ReportAnswer::class);
    } 
    
    public function createOrUpdateAnswers($answers)
    {
        if ($this->answers->isEmpty()) {
            $this->answers()->createMany($answers);
        } else {
            array_where($answers, function ($answer, $key) {
                if (empty($answer['id'])) {
                    $this->answers()->create($answer);
                } else {
                    $answer['is_required'] = $answer['is_required'] ?? false;
                    $answer['answer_variants'] = json_encode($answer['answer_variants']);
                    $this->answers()->where('id', $answer['id'])->update($answer);
                }
            });            
        }
    }    

}
