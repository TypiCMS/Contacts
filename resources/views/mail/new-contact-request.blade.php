@component('mail::message')
    #
    @lang('New contact request from')
    {{ $contact->name }}.

    @component('mail::panel')
        @foreach (\Illuminate\Support\Arr::except($contact->toArray(), ['id', 'created_at', 'updated_at']) as $key => $value)
            **{{ __(ucfirst($key)) }}**
            <br />
            {{ $value }}
            <br />
            <br />
        @endforeach
    @endcomponent

    @component('mail::button', ['url' => route('admin::edit-contact', $contact->id)])
        @lang('See online')
    @endcomponent
@endcomponent
