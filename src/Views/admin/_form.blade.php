@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('locale', App::getLocale()) !!}
{!! Honeypot::getFormHTML('my_name', 'my_time') !!}
{!! BootForm::hidden('my_time')->value(Crypt::encrypt(time()-60)) !!}

<div class="row">

    <div class="col-sm-2">
        {!! BootForm::select(trans('validation.attributes.title'), 'title', ['' => '', 'mr' => trans('validation.attributes.mr'), 'mrs' => trans('validation.attributes.mrs')]) !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text(trans('validation.attributes.first_name'), 'first_name') !!}
    </div>
    <div class="col-sm-5">
        {!! BootForm::text(trans('validation.attributes.last_name'), 'last_name') !!}
    </div>

</div>

{!! BootForm::email(trans('validation.attributes.email'), 'email') !!}
{!! BootForm::text(trans('validation.attributes.language'), 'language') !!}
{!! BootForm::text(trans('validation.attributes.website'), 'website') !!}
{!! BootForm::text(trans('validation.attributes.company'), 'company') !!}
{!! BootForm::text(trans('validation.attributes.address'), 'address') !!}
{!! BootForm::text(trans('validation.attributes.postcode'), 'postcode') !!}
{!! BootForm::text(trans('validation.attributes.city'), 'city') !!}
{!! BootForm::text(trans('validation.attributes.country'), 'country') !!}
{!! BootForm::text(trans('validation.attributes.phone'), 'phone') !!}
{!! BootForm::text(trans('validation.attributes.mobile'), 'mobile') !!}
{!! BootForm::text(trans('validation.attributes.fax'), 'fax') !!}
{!! BootForm::textarea(trans('validation.attributes.message'), 'message') !!}
