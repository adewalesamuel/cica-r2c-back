<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeRequest extends FormRequest
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
            'titre' => 'required|string',
			'mots_cles' => 'required|string',
			'auteurs' => 'required|json',
			'fichier' => 'nullable|file',
            'status' => 'nullable|string',
			'utilisateur_id' => 'required|integer|exists:utilisateurs,id',
        ];
    }
}