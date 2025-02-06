<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaRequest extends FormRequest
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
            'cliente_id'=>'required|integer',
            'desconto' => 'decimal:0,2',
            'produto_id'=> 'integer'
            
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
    { return [
        'cliente_id.required' => 'Este campo é obrigatorio',
        'desconto.decimal'=> 'Este campo só aceita numeros decimais até duas casas '
    ];
        
    }


}
