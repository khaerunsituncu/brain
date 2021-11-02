<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BandRequest extends FormRequest
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
            'name' => ['required', 'unique:bands,name,' . optional($this->band)->id],
            'genres' => ['required', 'array'],
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png,gif'
        ];
    }
}
