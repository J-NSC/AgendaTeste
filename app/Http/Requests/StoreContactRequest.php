<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string' ],
            'phone' => ['required', 'celular_com_ddd'],
            'email' => ['required', 'email'],
            'image' => ['required', 'image'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'O nome é obrigatório.',
            'phone.required'  => 'O telefone é obrigatório.',
            'phone.celular_com_ddd' => 'Informe um número de telefone válido com DDD.',
            'email.required'  => 'O e-mail é obrigatório.',
            'email.email'     => 'O e-mail informado não é válido.',
            'image.required'  => 'A imagem é obrigatória.',
            'image.image'     => 'O arquivo deve ser uma imagem válida.',
        ];
    }
}
