@component('mail::message')
# @lang('New contact request from') {{ $contact->name }}.

@component('mail::panel')
@foreach (Arr::except($contact->toArray(), ['id', 'created_at', 'updated_at', 'locale', 'privacy_policy_accepted']) as $key => $value)
<p>
<strong>{{ __(ucfirst($key)) }}</strong>
<br />
{{ $value }}
</p>
@endforeach
@endcomponent

@component('mail::button', ['url' => route('admin::edit-contact', $contact->id)])
@lang('See online')
@endcomponent
@endcomponent
