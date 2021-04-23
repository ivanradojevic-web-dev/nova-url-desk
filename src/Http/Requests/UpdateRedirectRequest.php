<?php

namespace Ivanradojevic\Urldesk\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Ivanradojevic\Urldesk\Models\Redirect;
use Illuminate\Validation\Rule;

class UpdateRedirectRequest extends FormRequest
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
        $id = $this->route('id');
        $redirect = Redirect::find($id);
        
        return [
            'redirect_from' => ['required','max:255',Rule::unique('redirects')->ignore($redirect)],
            'redirect_to' => 'required',
            'status_code' => 'required',
        ];

    }
}