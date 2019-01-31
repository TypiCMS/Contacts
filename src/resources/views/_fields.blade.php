{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('language')->value(isset($model->language) ? $model->language : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}
{!! BootForm::text('<span class="fa fa-asterisk"></span> '.__('Name'), 'name') !!}
{!! BootForm::email('<span class="fa fa-asterisk"></span> '.__('Email'), 'email') !!}
{{-- BootForm::text(__('Website'), 'website') --}}
{{-- BootForm::text(__('Company'), 'company') --}}
{{-- BootForm::text(__('Address'), 'address') --}}
{{-- BootForm::text(__('Postcode'), 'postcode') --}}
{{-- BootForm::text(__('City'), 'city') --}}
{{-- BootForm::text(__('Country'), 'country') --}}
{{-- BootForm::text(__('Phone'), 'phone') --}}
{{-- BootForm::text(__('Mobile'), 'mobile') --}}
{{-- BootForm::text(__('Fax'), 'fax') --}}
{!! BootForm::textarea('<span class="fa fa-asterisk"></span> '.__('Message'), 'message') !!}

<div class="form-group">
    <span class="fa fa-asterisk"></span> @lang('Mandatory fields')
</div>
