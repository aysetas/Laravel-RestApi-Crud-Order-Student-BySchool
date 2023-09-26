<?php

namespace App\Http\Requests\Store;

use App\Models\School;
use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2',
            'school_id' => 'required|exists:schools,id',
            'order' => 'nullable',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Öğrenci Adı zorunludur.',
            'name.min' => 'Öğrenci Adı :min karakterden oluşmak zorundadır.',

            'school_id.required' => 'Okul Adı Seçiniz.',
            'school_id.exists' => 'Seçili Okul Bulunamadı.',
        ];
    }

    /**
     * @return StoreStudentRequest
     */
    protected function passedValidation(): StoreStudentRequest
    {
        $input = $this->all();
        $schoolId = $input['school_id'];

        $data = $this->validator->getData();

        $orderData = Student::whereSchoolId($schoolId)
                ->max('order')+ 1;

        $this->validator->setData([
                'order' => $orderData,
            ] + $data);

        return $this;
    }
}
