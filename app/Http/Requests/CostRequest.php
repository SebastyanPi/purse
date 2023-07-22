<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CostRequest extends FormRequest
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
            'cod_alumno' => 'required',
            'valor_semestre' => 'required|min:0',
            'numero_semestre' => 'required|min:0',
            'valor_total_semestre' => 'required|min:0',
            'descuento' => 'required|min:0',
            'valor_neto' => 'required|min:0',
            'saldo_financiar' => 'required|min:0',
            'periodo' => 'required',
            'numero_cuotas' => 'required|min:0',
            'valor_cuotas' => 'required|min:0'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'valor_semestre' => Str::replace('.','',$this->valor_semestre),
            'valor_total_semestre' => Str::replace('.','',$this->valor_total_semestre),
            'descuento' => Str::replace('.','',$this->descuento),
            'valor_neto' => Str::replace('.','',$this->valor_neto),
            'saldo_financiar' => Str::replace('.','',$this->saldo_financiar),
            'valor_cuotas' => Str::replace('.','',$this->valor_cuotas),
        ]);
    }
}
