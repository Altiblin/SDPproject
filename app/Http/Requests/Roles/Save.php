<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AllInModel;
use App\Models\Role;

class Save extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'roles' => [ 'required', 'max:1']
        ];
    }

    public function attributes()
    {
        return [
            'roles' => 'Список ролей'
        ];
    }

    public function messages()
    {
        return [
            'roles.required' => 'Максимум 1 роль'
        ];
    }
}
