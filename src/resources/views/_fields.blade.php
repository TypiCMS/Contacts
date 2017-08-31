{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('language')->value(isset($model->language) ? $model->language : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}

<div class="row">

    <div class="col-sm-2">
        {!! BootForm::select('<span class="fa fa-asterisk"></span> '.__('Title'), 'title', ['' => '', 'mr' => __('Mr'), 'mrs' => __('Mrs')]) !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text('<span class="fa fa-asterisk"></span> '.__('First name'), 'first_name') !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text('<span class="fa fa-asterisk"></span> '.__('Last name'), 'last_name') !!}
    </div>

</div>

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
