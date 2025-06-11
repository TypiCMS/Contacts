<?php

namespace TypiCMS\Modules\Contacts\Exports;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Filters\FilterOr;

/**
 * @implements WithMapping<mixed>
 */
class Export implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping
{
    /** @return Collection<int, Model> */
    public function collection(): Collection
    {
        return QueryBuilder::for(Contact::class)
            ->allowedSorts(['created_at', 'name', 'email', 'message'])
            ->allowedFilters([
                AllowedFilter::custom('name,email,message', new FilterOr()),
            ])
            ->get();
    }

    /** @return array<int, mixed> */
    public function map(mixed $row): array
    {
        return [
            Date::dateTimeToExcel($row->created_at),
            Date::dateTimeToExcel($row->updated_at),
            $row->locale,
            $row->name,
            $row->email,
            $row->message,
        ];
    }

    /** @return string[] */
    public function headings(): array
    {
        return [
            __('Created at'),
            __('Updated at'),
            __('Locale'),
            __('Name'),
            __('Email'),
            __('Message'),
        ];
    }

    /** @return array<string, string> */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DATETIME,
            'B' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }
}
