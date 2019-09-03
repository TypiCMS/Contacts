<?php

namespace TypiCMS\Modules\Contacts\Models;

use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Contacts\Presenters\ModulePresenter;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\History\Traits\Historable;

class Contact extends Base
{
    use Historable;
    use PresentableTrait;

    protected $presenter = ModulePresenter::class;

    protected $guarded = ['id', 'exit', 'my_name', 'my_time'];

    public function uri($locale = null): string
    {
        return url('/');
    }
}
