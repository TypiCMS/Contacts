<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Contacts\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use TypiCMS\Modules\Core\Models\History;
use TypiCMS\Modules\Core\Traits\HasAdminUrls;
use TypiCMS\Modules\Core\Traits\HasConfigurableOrder;
use TypiCMS\Modules\Core\Traits\HasPresenterMethods;
use TypiCMS\Modules\Core\Traits\HasSelectableFields;
use TypiCMS\Modules\Core\Traits\HasSlugScope;
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
class Contact extends Model
{
    use HasAdminUrls;
    use HasConfigurableOrder;
    use HasPresenterMethods;
    use HasSelectableFields;
    use HasSlugScope;
    use Historable;

    protected $guarded = ['my_name', 'my_time'];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'privacy_policy_accepted' => 'boolean',
        ];
    }

    public function formattedCreatedAt(): string
    {
        return $this->created_at->format('d.m.Y');
    }

    public function presentTitle(): string
    {
        return $this->name;
    }
}
