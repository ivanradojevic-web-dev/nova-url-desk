<?php

namespace Ivanradojevic\Urldesk\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRedirectRequest extends FormRequest
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
            'redirect_from' => 'required|max:255|unique:redirects',
            'redirect_to' => 'required|unique:redirects',
            'status_code' => 'required',
        ];
    }
}
