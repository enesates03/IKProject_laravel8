<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CompanyFormRequest extends FormRequest
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
        $id = $this->route('company')?->id;
        return [
            'name'=>['required',Rule::unique('companies')->ignore($id)],
            'phone' =>'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address'=>'nullable',
            'email'=>'email|nullable',
            'logo'=>'image|nullable|max:2048',
            'website'=>'nullable'
        ];
    }
}
