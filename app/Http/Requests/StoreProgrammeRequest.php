<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgrammeRequest extends FormRequest
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
            'titre'        => 'required|string',
            'description'  => 'nullable|string',
            'nbr_places'   => 'nullable|integer',
            'date'         => 'required|date',
            'heure'        => 'required|string',
            'categorie_id' => 'required|integer|exists:categories,id'
        ];
    }
}
