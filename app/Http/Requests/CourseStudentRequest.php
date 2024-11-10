<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CourseStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id'=>['required','integer',Rule::unique('course_student')->where('course_id',$this->course_id)->where('student_id',$this->student_id)->ignore($this->id)],
            'student_id'=>['required','integer',Rule::unique('course_student')->where('course_id',$this->course_id)->where('student_id',$this->student_id)->ignore($this->id)],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "course_id.unique" => "هذا الكورس يحضره الطالب مسبقا",
            "student_id.unique" => "هذا الطالب يحضر الكورس مسبقا"
        ];
    }
}
