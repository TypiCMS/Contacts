@component('mail::message')
#
@lang('Hello!')

@lang('Thank you for your contact request.')

@component('mail::panel')
@foreach (\Illuminate\Support\Arr::except($contact->toArray(), ['id', 'created_at', 'updated_at', 'locale']) as $key => $value)
**{{ __(ucfirst($key)) }}**
<br />
{{ $value }}
<br />
<br />
@endforeach
@endcomponent

@lang('Regards')
,
<br />
{{ websiteTitle() }}
@endcomponent
