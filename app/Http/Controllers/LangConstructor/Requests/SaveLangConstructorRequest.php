<?php


namespace App\Http\Controllers\LangConstructor\Requests;

use App\Http\Requests\FormRequest;


class SaveLangConstructorRequest extends FormRequest
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

    public function rules()
    {

        $rule = [
            'name' => 'required|string',
            'code' => 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:constructions|max:255',
            'hard' => 'required|integer|between:0,100',
            'type_code' => 'required',
            'description' => 'required|string'
        ];

        if ($this->id) {
            $rule['code'] = 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:construction_types,id,' . $this->id . '|max:255';
        } else {
            $rule['code'] = 'required|string|regex:/^[a-zA-Z0-9\-\_]+$/u|unique:constructions,id,' . $this->id . '|max:255';
        }


        return $rule;


    }

    public function getFormData()
    {

        $data = $this->request->all();
        $data['created_account_id'] = auth()->user()->account->id;

        return $data;
    }

}
