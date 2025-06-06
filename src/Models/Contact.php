<?php

namespace TypiCMS\Modules\Contacts\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Contacts\Presenters\ModulePresenter;
use TypiCMS\Modules\Core\Models\Base;
use TypiCMS\Modules\Core\Models\History;
use TypiCMS\Modules\Core\Traits\Historable;

/**
 * @property int $id
 * @property string|null $locale
 * @property string|null $name
 * @property string $email
 * @property string|null $message
 * @property bool $privacy_policy_accepted
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, History> $history
 * @property-read int|null $history_count
 * @property-write mixed $status
 */
class Contact extends Base
{
    use Historable;
    use PresentableTrait;

    protected string $presenter = ModulePresenter::class;

    protected $guarded = ['my_name', 'my_time'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'privacy_policy_accepted' => 'boolean',
        ];
    }
}
