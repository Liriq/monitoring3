<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                     'name'             => 'required|string|max:255', 
                     'lastname'         => 'nullable|string|max:255', 
                     'note'             => 'nullable|max:2048', 
                     'email'            => 'required|string|unique:users,email|max:255',  
                     'password' => 'required|string|max:255',
                 ];
                 break;
             }
             case 'PUT':
             case 'PATCH':
             {
                 $rules = [
                     'name'             => 'required|string|max:255',  
                     'lastname'         => 'nullable|string|max:255', 
                     'note'             => 'nullable|max:2048', 
                     'email'            => 'required|string|max:255|unique:users,email,'.$this->id, 
                     'password' => 'nullable|string|max:255', 
                 ];
             }
             default: break;
         }
         
         return $rules; 
     }
}
