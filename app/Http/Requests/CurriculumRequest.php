<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class CurriculumRequest extends FormRequest
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

   // バリデーションルール   
   public function rules(): array{  

        return [
            'title' => 'required|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
            'video_url' => ['required', 'string', 'regex:/^[a-zA-Z0-9:\/\.\-\?\=\&\_\%]+$/'],
            'description' => 'required|string',
            'alway_delivery_flg' => 'nullable|string|in:on',
            'thumbnail' => 'nullable|file|mimes:jpg,jpeg,png',
        ];
    }

   


  // バリデーションメッセージ
  public function messages(): array{
    
    return [
        'title.required'      => '授業名は入力必須です。',
        'video_url.required'  => '動画URLは入力必須です。',
        'video_url.url'       => '動画URLは正しいURL形式で入力してください。',
        'description.required'=> '授業概要は入力必須です。',
        'grade_id.required'   => '学年の選択は必須です。',
        'thumbnail.mimes'     => '画像ファイルはjpg、pngいずれかの形式のみです。',
        
    ];
}
}

