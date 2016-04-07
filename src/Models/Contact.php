<?php

namespace TypiCMS\Modules\Contacts\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Contact extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Contacts\Presenters\ModulePresenter';

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'email',
        'language',
        'website',
        'company',
        'address',
        'postcode',
        'city',
        'country',
        'phone',
        'mobile',
        'fax',
        'message',
    ];
}
