{!! Honeypot::generate('my_name', 'my_time') !!}
{!! BootForm::hidden('language')->value(isset($model->language) ? $model->language : config('app.locale')) !!}
{!! BootForm::hidden('id') !!}

<div class="row">

    <div class="col-sm-2">
        {!! BootForm::select('<span class="fa fa-asterisk"></span> '.__('validation.attributes.title'), 'title', ['' => '', 'mr' => __('validation.attributes.mr'), 'mrs' => __('validation.attributes.mrs')]) !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text('<span class="fa fa-asterisk"></span> '.__('validation.attributes.first_name'), 'first_name') !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text('<span class="fa fa-asterisk"></span> '.__('validation.attributes.last_name'), 'last_name') !!}
    </div>

</div>

{!! BootForm::email('<span class="fa fa-asterisk"></span> '.__('validation.attributes.email'), 'email') !!}
{{-- BootForm::text(__('validation.attributes.website'), 'website') --}}
{{-- BootForm::text(__('validation.attributes.company'), 'company') --}}
{{-- BootForm::text(__('validation.attributes.address'), 'address') --}}
{{-- BootForm::text(__('validation.attributes.postcode'), 'postcode') --}}
{{-- BootForm::text(__('validation.attributes.city'), 'city') --}}
{{-- BootForm::text(__('validation.attributes.country'), 'country') --}}
{{-- BootForm::text(__('validation.attributes.phone'), 'phone') --}}
{{-- BootForm::text(__('validation.attributes.mobile'), 'mobile') --}}
{{-- BootForm::text(__('validation.attributes.fax'), 'fax') --}}
{!! BootForm::textarea('<span class="fa fa-asterisk"></span> '.__('validation.attributes.message'), 'message') !!}

<div class="form-group">
    <span class="fa fa-asterisk"></span> @lang('global.Mandatory fields')
</div>
