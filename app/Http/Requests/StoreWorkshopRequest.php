<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'owner';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => ['required','string','max:150'],
            'city'        => ['required','string','max:120'],
            'address'     => ['required','string','max:200'],
            'phone'       => ['required','string','max:40'],
            'description' => ['nullable','string','max:2000'],

            // zabranjujemo da korisnik šalje ova polja, dodatna zastita? da li je to ok
            'owner_id'    => ['prohibited'],
            'is_verified' => ['prohibited'],
            'avg_rating'  => ['prohibited'],
        ];
    }
}
