@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}

@include('contacts::_fields')

{!! BootForm::hidden('my_time')->value(Crypt::encrypt(time()-60)) !!}
