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
        //TODO add conditional validation for cases if components are not added
        $rules = [
            'id' => ['nullable'],
            'phone' => ['required', 'numeric', 'digits_between:8,14'],
            'birth_date' => ['required', 'date', 'before:today'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'picture' => ['nullable'],
            'educations.*.educations_id' => ['nullable', 'numeric'],
            'educations.*.education_level' => ['nullable', 'string'],
            'educations.*.education_institution' => ['nullable', 'string'],
            'educations.*.education_start_date' => ['nullable', 'date'],
            'educations.*.education_end_date' => ['nullable', 'date'],
            'experiences.*.experiences_id' => ['nullable', 'numeric'],
            'experiences.*.experience_company' => ['nullable', 'string'],
            'experiences.*.experience_position' => ['nullable', 'string'],
            'experiences.*.experience_business_type' => ['nullable', 'string'],
            'experiences.*.experience_start_date' => ['nullable', 'date'],
            'experiences.*.experience_end_date' => ['nullable', 'date'],
            'languages.*.languages_id' => ['nullable', 'numeric'],
            'languages.*.language_name' => ['nullable', 'string'],
            'languages.*.language_level' => ['nullable', 'numeric'],
            'licenses.*.licenses_id' => ['nullable', 'numeric'],
            'licenses.*.license_name' => ['nullable', 'string'],
            'licenses.*.license_institution' => ['nullable', 'string'],
            'licenses.*.license_id' => ['nullable', 'string'],
            'licenses.*.license_issue_date' => ['nullable', 'date', 'before:today'],
            'skills.*.skills_id' => ['nullable', 'numeric'],
            'skills.*.skill_name' => ['nullable', 'string'],
            'skills.*.skill_level' => ['nullable', 'numeric'],
        ];
        if (request()->isMethod('PATCH')) {
            $rules['id'] = ['required', 'integer', 'exists:cv,id'];
        }
        return $rules;
    }
}
