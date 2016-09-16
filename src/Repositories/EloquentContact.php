<?php

namespace TypiCMS\Modules\Contacts\Repositories;

use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\EloquentRepository;

class EloquentContact extends EloquentRepository
{
    protected $repositoryId = 'contacts';

    protected $model = Contact::class;
}
