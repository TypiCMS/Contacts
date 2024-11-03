{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : app()->getLocale()) !!}
{!! BootForm::hidden('id') !!}
{!! BootForm::text(__('Name') . ' <span class="required_mark">*</span>', 'name')->required()->autocomplete('on') !!}
{!! BootForm::email(__('Email') . ' <span class="required_mark">*</span>', 'email')->required()->autocomplete('on') !!}
{!! BootForm::textarea(__('Message') . ' <span class="required_mark">*</span>', 'message')->required() !!}

<div class="mb-3">
    {!! BootForm::checkbox(__('I agree to the Privacy Policy') . ' <span class="required_mark">*</span>', 'privacy_policy_accepted')->required() !!}
</div>

<div class="mb-3">
    <span class="required_mark">*</span>
    @lang('Mandatory fields')
</div>
