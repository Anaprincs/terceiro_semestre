<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaUpdateRequest extends FormRequest
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
            
                'cliente_id'=>'integer',
                'desconto.decimal' => 'decimal:2,2'
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
    return[
        'cliente_id.integer'=> 'Este campo só aceita numeros inteiros',
        'desconto.decimal' => 'Este campo só aceita numeros decimais com numeros inteiros'
    ];
 } 
}
