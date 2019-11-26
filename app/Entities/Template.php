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
        'color',
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
            foreach($questions as $q) {
                $q['template_id'] = $this->id;
                $question = new TemplateQuestion;
                $question->fill($q)->save();
            }
        } else {
            foreach ($questions as $q) {
                if (empty($q['id'])) {
                    $q['template_id'] = $this->id;
                    $question = new TemplateQuestion;
                    $question->fill($q)->save();
                } else {
                    $q['is_required'] = $q['is_required'] ?? false;
                    TemplateQuestion::find($q['id'])->update($q);
                }
            }
        }
    }

}
