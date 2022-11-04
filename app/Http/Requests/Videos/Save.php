<?php

namespace App\Http\Requests\Videos;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AllInModel;
use App\Models\Tag;

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
            'code' => 'required|min:11|max:16',
            'tags' => [ 'required', 'array', 'min:1', new AllInModel(Tag::class) ],
        ];
    }

    public function attributes()
    {
        return [
            'code' => 'Код ютуба',
        ];
    }
}
