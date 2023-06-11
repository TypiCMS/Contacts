{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}
{!! BootForm::text(__('Name') . ' <span class="asterisk">*</span>', 'name')->required() !!}
{!! BootForm::email(__('Email') . ' <span class="asterisk">*</span>', 'email')->required() !!}
{!! BootForm::textarea(__('Message') . ' <span class="asterisk">*</span>', 'message')->required() !!}
{!! BootForm::checkbox(__('I agree to the Privacy Policy') . ' <span class="asterisk">*</span>', 'privacy_policy_accepted')->required() !!}

<div class="mb-3">
    <span class="asterisk">*</span>
    @lang('Mandatory fields')
</div>
