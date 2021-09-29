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
        return [
            //'name' => ['required',Rule::unique('name')->ignore($this->id)],
            //'name' => 'required|unique:companies,name,'.$this->company->id,
            //'name'=>'required|unique:companies',
            'name'=>'required',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email'=>'email|nullable',
            'website'=>'nullable'
        ];
    }
}
