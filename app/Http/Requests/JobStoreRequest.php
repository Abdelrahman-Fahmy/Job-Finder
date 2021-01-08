<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'company_name' => 'required|max:255',
            'job_type' => 'required',
            'location' => 'required',
            'job_details' => 'required',
            'salary' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/'
        ];
    }
}
