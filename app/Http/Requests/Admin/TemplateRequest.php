<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Entities\TemplateQuestion;

class TemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        switch($this->method())
        {
            case 'POST':
            {
                $rules = [                    
                    'name' => 'required|string|max:255|unique:templates,name',
                    'questions' => 'required|array',
                    'questions.*.question' => 'required|string|max:255',
                    'questions.*.hint' => 'nullable|string|max:255',
                    'questions.*.is_required' => 'nullable|numeric|in:1',
                    'questions.*.answer_variants' => 'required_if:answer_type,' . TemplateQuestion::TYPE_SELECT,                    
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [                    
                    'name' => 'required|string|max:255|unique:templates,name,'.$this->id,
                    'questions' => 'required|array',
                    'questions.*.question' => 'required|string|max:255',
                    'questions.*.hint' => 'nullable|string|max:255',
                    'questions.*.is_required' => 'nullable|numeric|in:1',
                    'questions.*.answer_variants' => 'required_if:questions.*.answer_type,' . TemplateQuestion::TYPE_SELECT,  
                ];
            }
            default: break;
        }
        
        return $rules;
    }
        
}
