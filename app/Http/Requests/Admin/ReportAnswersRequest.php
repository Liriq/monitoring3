<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\Template;
use App\Entities\Report;

class ReportAnswersRequest extends FormRequest
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
        return [
            'template_id' => [
                'required',
                Rule::in(Template::pluck('id')->toArray()),
            ],
            'report_id' => [
                'nullable',
                Rule::in(Report::pluck('id')->toArray()),
            ],
        ];
    }
}
