{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}
{!! BootForm::text(__('Name') . ' <span class="asterisk">*</span>', 'name') !!}
{!! BootForm::email(__('Email') . ' <span class="asterisk">*</span>', 'email') !!}
{{-- BootForm::text(__('Website'), 'website') --}}
{{-- BootForm::text(__('Company'), 'company') --}}
{{-- BootForm::text(__('Address'), 'address') --}}
{{-- BootForm::text(__('Postcode'), 'postcode') --}}
{{-- BootForm::text(__('City'), 'city') --}}
{{-- BootForm::text(__('Country'), 'country') --}}
{{-- BootForm::text(__('Phone'), 'phone') --}}
{{-- BootForm::text(__('Mobile'), 'mobile') --}}
{{-- BootForm::text(__('Fax'), 'fax') --}}
{!! BootForm::textarea(__('Message') . ' <span class="asterisk">*</span>', 'message') !!}

<div class="form-group">
    <span class="asterisk">*</span> @lang('Mandatory fields')
</div>
