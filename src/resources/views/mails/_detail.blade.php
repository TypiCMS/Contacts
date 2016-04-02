<table style="border-collapse: collapse;">
@foreach ($model->getFillable() as $column)
    @if ($model->$column)
    <tr>
        <th style="border-top: 1px solid #ddd; padding: 5px; text-align: left">@lang('validation.attributes.'.$column)</th>
        <td style="border-top: 1px solid #ddd; padding: 5px">{{ $model->$column }}</td>
    </tr>
    @endif
@endforeach
</table>
