<?php

namespace TypiCMS\Modules\Contacts\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Contacts\Presenters\ModulePresenter;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Core\Traits\Historable;

class Contact extends Base
{
    use Historable;
    use PresentableTrait;

    protected string $presenter = ModulePresenter::class;

    protected $guarded = ['my_name', 'my_time'];

    protected $casts = [
        'privacy_policy_accepted' => 'boolean',
    ];
}
