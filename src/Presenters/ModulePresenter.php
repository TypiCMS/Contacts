<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Contacts\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class ModulePresenter extends Presenter
{
    /**
     * Format creation date.
     */
    public function createdAt(): string
    {
        return $this->entity->created_at->format('d.m.Y');
    }

    /**
     * The title is the name.
     */
    public function title(): string
    {
        return $this->entity->name;
    }
}
