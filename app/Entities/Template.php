<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    
    public function createOrUpdateQuestions($questions)
    {
        if ($this->questions->isEmpty()) {
            $this->questions()->createMany($questions);
        } else {
            array_where($questions, function ($question, $key) {
                if (empty($question['id'])) {
                    $this->questions()->create($question);
                } else {
                    $question['is_required'] = $question['is_required'] ?? false;
                    $question['answer_variants'] = json_encode($question['answer_variants']);
                    $this->questions()->where('id', $question['id'])->update($question);
                }
            });            
        }
    }
        
}
