<?php

namespace TypiCMS\Modules\Contacts\Http\Requests;

use TypiCMS\Modules\Core\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|max:255',
            'locale' => 'required|max:5',
            'name' => 'required|max:255',
            'message' => 'required',
            'privacy_policy_accepted' => 'accepted',
            'my_name' => 'honeypot',
            'my_time' => 'required|honeytime:5',
        ];
    }
}
