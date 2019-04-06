<?php

namespace TypiCMS\Modules\Contacts\Presenters;

use TypiCMS\Modules\Core\Presenters\Presenter;

class ModulePresenter extends Presenter
{
    /**
     * Format creation date.
     *
     * @return string
     */
    public function createdAt()
    {
        return $this->entity->created_at->format('d.m.Y');
    }

    /**
     * The title is the name.
     *
     * @return string
     */
    public function title()
    {
        return $this->entity->name;
    }
}
