<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:settings,name', 
                    'value' => 'required|string|max:255',
                    'description' => 'nullable|string|max:2048',
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rules = [                    
                    'name' => 'required|string|max:255|unique:settings,name,'.$this->id, 
                    'value' => 'required|string|max:255',
                    'description' => 'nullable|string|max:2048',
                ];
            }
            default: break;
        }
        
        return $rules;        
    }
}
