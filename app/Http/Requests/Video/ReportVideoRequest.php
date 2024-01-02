<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class ReportVideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'link' => ['required', 'string'],
<<<<<<< HEAD
            'optision' => ['nullable', 'string'],
=======
            'type' => ['required', 'string'],
            'optision' => ['nullable', 'string']
>>>>>>> 6bd6631 (update queue and report , route ,)
        ];
    }
}
