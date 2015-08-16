<?php

namespace App\Http\Requests;

class AddBookRequest extends Request
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
            'title' => 'required|min:3',
            'isbn' => 'sometimes|required|numeric|unique:books',
            'author' => 'required|array',
            'publisher' => 'required|array',
            'summary' => 'required',
            'year' => 'required|date',
            'edition' => 'required|numeric',
            'quantity' => 'required|numeric',
            'attachment' => 'image',
        ];
    }
}
