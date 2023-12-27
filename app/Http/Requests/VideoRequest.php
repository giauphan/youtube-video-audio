<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'url' => 'Đường dẫn video youtube',
        ];
    }
}
