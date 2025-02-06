<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemVendaRequest extends FormRequest
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
            'venda_id'=>'integer|required',
            'produto_id' => 'integer|required',
            'quantidade' => 'integer|',
            'preco_unitario' => 'required|decimal:0,2'
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
            'produto_id.integer' => 'Este campo só aceita numeros inteiros',
            'preco_unitario.required' => 'Este campo é obrigatorio',
            'produto_id.required' => 'Este campo é obrigatorio',
            'quantidade.integer' => 'Este campo só aceita numeros inteiros',
            'quantidade.integer' => 'Este campo só aceita numeros inteiros',
            'preco_unitario.required' => 'Este campo é obrigatorio'
        ];
    }
}
