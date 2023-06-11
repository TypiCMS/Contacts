<div class="header">
    @include('core::admin._button-back', ['url' => $model->indexUrl(), 'title' => __('Contacts')])
    @include('core::admin._title', ['default' => __('New contact')])
    @component('core::admin._buttons-form', ['model' => $model, 'langSwitcher' => false])
        
    @endcomponent
</div>

<div class="content">
    @include('contacts::_fields')

    {!! BootForm::hidden('my_time')->value(Crypt::encrypt(time() - 60)) !!}
</div>
