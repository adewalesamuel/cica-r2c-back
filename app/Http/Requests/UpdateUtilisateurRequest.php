<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUtilisateurRequest extends FormRequest
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
            'nom'                     => 'required|string',
            'prenom'                  => 'required|string',
            'email'                   => 'required|email',
            'mot_de_passe'            => 'required|string',
            'civilite'                => 'nullable|string',
            'fonction'                => 'required|string',
            'specialite'              => 'required|string',
            'profession'              => 'required|string',
            'societe'                 => 'required|string',
            'service'                 => 'required|string',
            'adresse'                 => 'nullable|string',
            'code_postal'             => 'required|string',
            'ville'                   => 'required|string',
            'pays'                    => 'required|string',
            'telephone'               => 'required|string',
            'fax'                     => 'nullable|string',
            'autres'                  => 'nullable|string',
            'has_accepted_conditions' => 'nullable|boolean',
            'is_r2c_member'           => 'nullable|boolean'
        ];
    }
}
