<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInscriptionRequest extends FormRequest
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
            'pack_id' => 'required|integer|exists:packs,id',
			'programme_id' => 'required|integer|exists:programmes,id',
			'utilisateur_id' => 'required|integer|exists:utilisateurs,id',
			'prix' => 'required|integer',
			'mode_paiement' => 'required|string',			
			'status_paiement' => 'nullable|string'			
        ];
    }
}