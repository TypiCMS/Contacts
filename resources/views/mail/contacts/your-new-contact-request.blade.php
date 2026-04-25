@component('mail::message')
# @lang('Hello!')

@lang('Thank you for your contact request.')

@component('mail::panel')
@foreach (Arr::except($contact->toArray(), ['id', 'created_at', 'updated_at', 'locale', 'privacy_policy_accepted']) as $key => $value)
<p>
<strong>{{ __(ucfirst($key)) }}</strong>
<br />
{{ $value }}
</p>
@endforeach
@endcomponent

@lang('Regards'),
<br />
{{ websiteTitle() }}
@endcomponent
