<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'video_id' => ['required'],
            'title' => ['required'],
            'url_video' => ['required'],
            'thumbnail' => ['required'],
            'type' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'video_id' => 'Mã video ',
            'title' => 'Tiêu đề video',
            'url_video' => ' Đương dẫn video',
            'thumbnail' => 'Ảnh video',
            'type' => 'Loại video',
        ];
    }
}
