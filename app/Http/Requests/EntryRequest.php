<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EntryRequest extends FormRequest
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
            'id_cost' => 'required',
            'concepto' => 'required',
            'descripcion' => 'required',
            'fecha_recibo' => 'required',
            'valor' => 'required',
            'elaborado_por' => 'required',
            'debe' => 'required',
            'haber' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'valor' => Str::replace('.','',$this->valor)
        ]);
    }
}
