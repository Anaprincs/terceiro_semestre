<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|min:3',
            'codigo' => 'unique:produtos,codigo'

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => 'Erro de validação',
                'erros' => $validator->errors()
            ], 422)
        );
    }

    public function messages()
    {
        return [
            'nome.required' => 'Este campo é obrigatorio',
            'nome.min' => 'Este campo precisa no mínimo 3 caracteres',
            'codigo.unique' => ' Este campo é unico'
        ];
    }
}
