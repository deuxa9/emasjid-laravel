<?php

namespace App\Http\Requests;

use Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreKurbanHewanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'kurban_id' => 'required|exists:kurbans,id',
            'hewan' => 'required|in:kambing,sapi,domba,kerbau,unta',
            'iuran_perorang' => 'required|numeric',
            'kriteria' => 'nullable',
            'harga' => 'nullable|numeric',
            'biaya_operasional' => 'nullable|numeric',  
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'iuran_perorang' => str_replace('.', '', $this->iuran_perorang),
            'harga' => str_replace('.', '', $this->harga),
            'biaya_operasional' => str_replace('.', '', $this->biaya_operasional),
        ]);
    }
}
