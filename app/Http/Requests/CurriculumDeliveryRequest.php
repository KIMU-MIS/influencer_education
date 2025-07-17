<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class CurriculumDeliveryRequest extends FormRequest
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
public function rules()
{  
    
    return [
        'delivery_from' => 'required|array',
        'delivery_from.*' => 'required|date',
        'delivery_to' => 'required|array',
        'delivery_to.*' => 'required|date|after_or_equal:delivery_from.*', // 複雑なら withValidator で対応
    ];
    
    }



// バリデーションメッセージ
public function messages()
{
    return [
        
        'delivery_from.required' => '配信開始日時は必須です。',
        'delivery_to.required'   => '配信終了日時は必須です。',
    ];
}
}