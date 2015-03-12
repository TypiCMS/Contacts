<?php
namespace TypiCMS\Modules\Contacts\Http\Requests;

use TypiCMS\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest {

    public function rules()
    {
        $rules = [
            'email'      => 'required|email',
            'title'      => 'required',
            'first_name' => 'required',
            'last_name'  => 'required',
            'message'    => 'required',
            'website'    => 'url',
            'my_name'    => 'honeypot',
            'my_time'    => 'required|honeytime:5',
        ];
        return $rules;
    }
}
