<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content'=> 'required|string',
            'reference' => 'required|string',
            'term_id' => 'nullable|uuid|exists:terms,uuid',
            'collage_id' =>'required|uuid|exists:collages,uuid',
            'specialization_id' => 'required|uuid|exists:specializations,uuid'
        ];
    }
}
