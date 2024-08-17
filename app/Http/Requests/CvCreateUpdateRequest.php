<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class CvCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'id' => ['nullable'],
            'phone' => ['required', 'numeric', 'digits_between:8,14'],
            'birth_date' => ['required', 'date', 'before:today'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'picture' => ['nullable'],
            'educations.*.education_level' => ['required', 'string'],
            'educations.*.education_institution' => ['required', 'string'],
            'educations.*.education_start_date' => ['required', 'date'],
            'educations.*.education_end_date' => ['nullable', 'date'],
            'experiences.*.experience_company' => ['required', 'string'],
            'experiences.*.experience_position' => ['required', 'string'],
            'experiences.*.experience_business_type' => ['required', 'string'],
            'experiences.*.experience_start_date' => ['required', 'date'],
            'experiences.*.experience_end_date' => ['nullable', 'date'],
            'languages.*.language_name' => ['required', 'string'],
            'languages.*.language_level' => ['required', 'numeric'],
            'licenses.*.license_name' => ['required', 'string'],
            'licenses.*.license_institution' => ['required', 'string'],
            'licenses.*.license_id' => ['nullable', 'string'],
            'licenses.*.license_issue_date' => ['nullable', 'date', 'before:today'],
            'skills.*.skill_name' => ['required', 'string'],
            'skills.*.skill_level' => ['required', 'numeric'],
        ];
        if (request()->isMethod('PATCH')) {
            $rules['id'] = ['required', 'integer', 'exists:cv,id'];
        }
        return $rules;
    }
}
