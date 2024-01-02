<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class ReportVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'link' => ['required', 'string'],
            'optision' => ['nullable', 'string'],
        ];
    }
}
