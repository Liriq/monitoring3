<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\Template;
use App\Entities\User;

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
                    'template_id' => [
                        'required',
                        Rule::in(Template::pluck('id')->toArray()),
                    ],
                    'published_at' => 'required|date',
                    'user_id' => [
                        'required',
                        Rule::in(User::employee()->pluck('id')->toArray()),
                    ],
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [                    
                    'template_id' => [
                        'required',
                        Rule::in(Template::pluck('id')->toArray()),
                    ],
                    'published_at' => 'required|date',
                    'user_id' => [
                        'required',
                        Rule::in(User::employee()->pluck('id')->toArray()),
                    ],
                ];
            }
            default: break;
        }
        
        return $rules;         
    }
}
