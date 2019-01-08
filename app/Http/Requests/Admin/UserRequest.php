<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Entities\UserArea;

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
                     'name' => 'required|string|max:255', 
                     'lastname' => 'nullable|string|max:255', 
                     'note' => 'nullable|max:2048', 
                     'email' => 'required|string|unique:users,email|max:255',  
                     'password' => 'required|string|max:255',
                     'areas' => 'nullable|array',
                     'areas.radius' => 'nullable|numeric',
                     'areas.latitude' => 'nullable|numeric',
                     'areas.longitude' => 'nullable|numeric',
                 ];
                 break;
             }
             case 'PUT':
             case 'PATCH':
             {
                 $rules = [
                     'name' => 'required|string|max:255',  
                     'lastname' => 'nullable|string|max:255', 
                     'note' => 'nullable|max:2048', 
                     'email' => 'required|string|max:255|unique:users,email,'.$this->id, 
                     'password' => 'nullable|string|max:255', 
                     'areas' => 'nullable|array',
                     'areas.radius' => 'nullable|numeric',
                     'areas.latitude' => 'nullable|numeric',
                     'areas.longitude' => 'nullable|numeric',
                 ];
             }
             default: break;
         }
         
         return $rules; 
     }
     
     /**
      * @param Validator $validator
      */
     public function withValidator(Validator $validator): void
     {
         $validator->after(
             function (Validator $validator) {
                 $userAreas = UserArea::whereNotIn('id', $this->id ? [$this->id] : [])->get();
                 foreach ($userAreas as $userArea) {
                     $distance = $this->getDistance($userArea->latitude, $userArea->longitude, $this->areas['latitude'], $this->areas['longitude']);
                     if ($distance < ($userArea->radius + $this->areas['radius'])) {
                         $validator->errors()->add(
                             'areas.radius',
                             _i("User's area shouldn't match with another areas")
                         );                         
                     }
                 }
             }
         );
     }
     
     public function getDistance($latitude1, $longitude1, $latitude2, $longitude2 ) {  
         $earth_radius = UserArea::EARTH_RADIUS;

         $dLat = deg2rad( $latitude2 - $latitude1 );  
         $dLon = deg2rad( $longitude2 - $longitude1 );  

         $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
         $c = 2 * asin(sqrt($a));  
         $d = $earth_radius * $c;  

         return round($d);  
     }        
     
}
