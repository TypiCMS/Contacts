@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

@include('contacts::_fields')

{!! BootForm::hidden('my_time')->value(Crypt::encrypt(time()-60)) !!}
