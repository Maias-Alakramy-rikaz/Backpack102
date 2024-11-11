<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeacherRequest extends FormRequest
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
            'first_name' => ['required','string','max:255',Rule::unique('students')->where('first_name',$this->first_name)->where('last_name',$this->last_name)->ignore($this->id)], 
            'last_name' => ['required','string','max:255',Rule::unique('students')->where('first_name',$this->first_name)->where('last_name',$this->last_name)->ignore($this->id)],
            'birthday' => ['required','date','before:-18years']
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
            "first_name.unique" => "هذا الأستاذ (اسم وكنية) موجود مسبقا",
            "last_name.unique" => "هذا الأستاذ (اسم وكنية) موجود مسبقا",
            "birthday.before" =>  "يجب أن يكون أكبر من 18 سنة"
        ];
    }
}
