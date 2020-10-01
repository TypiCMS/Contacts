<?php

namespace TypiCMS\Modules\Contacts\Exports;

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

class Export implements WithColumnFormatting, ShouldAutoSize, FromCollection, WithHeadings, WithMapping
{
    protected $collection;

    public function __construct($request)
    {
        $this->collection = QueryBuilder::for(Contact::class)
            ->allowedSorts(['created_at', 'name', 'email', 'message'])
            ->allowedFilters([
                AllowedFilter::custom('name,email,message', new FilterOr()),
            ])
            ->get();
    }

    public function map($model): array
    {
        return [
            Date::dateTimeToExcel($model->created_at),
            Date::dateTimeToExcel($model->updated_at),
            $model->locale,
            $model->name,
            $model->email,
            $model->message,
        ];
    }

    public function headings(): array
    {
        return [
            'created_at',
            'updated_at',
            'locale',
            'name',
            'email',
            'message',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DATETIME,
            'B' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function collection()
    {
        return $this->collection;
    }
}
