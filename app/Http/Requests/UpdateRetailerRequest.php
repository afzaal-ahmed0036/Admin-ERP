<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRetailerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:255',
                    Rule::unique('users')->ignore($this->retailer->id)->where('deleted_at', NULL),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->retailer->id)->where('deleted_at', NULL),

            ],
            'phone' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($this->retailer->id)->where('deleted_at', NULL),

            ],
            'shop_name' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($this->retailer->id)->where('deleted_at', NULL),
            ],
        ];
    }
}
