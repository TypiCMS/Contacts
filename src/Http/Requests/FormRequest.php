<?php

namespace TypiCMS\Modules\Contacts\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
            'message' => 'required|max:255',
            'my_name' => 'honeypot',
            'my_time' => 'required|honeytime:5',
        ];
    }
}
