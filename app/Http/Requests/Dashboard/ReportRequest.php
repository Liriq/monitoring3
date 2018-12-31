<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
                    'published_at' => 'required|date',
                    'answers' => 'required|array',
                    'answers.*.question_id' => 'required|string|max:255',
                    'answers.*.answer' => 'required|min:1|max:255',
                    'answers.*.answer.*' => 'required|max:255|min:1',
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [
                    'published_at' => 'required|date',
                    'answers' => 'required|array',
                    'answers.*.id' => 'required|string|min:1|max:255',
                    'answers.*.answer' => 'required|min:1|max:255',
                    'answers.*.answer.*' => 'required|max:255|min:1',
                ];
                break;
            }
            default: break;
        }
        
        return $rules;  
    }
}
