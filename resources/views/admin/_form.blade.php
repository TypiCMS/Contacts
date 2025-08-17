<div class="header">
    <x-core::back-button :url="$model->indexUrl()" :title="__('Contacts')" />
    <x-core::title :$model :default="__('New contact')" />
    <x-core::form-buttons :$model :lang-switcher="false" />
</div>

<div class="content">
    @include('contacts::_fields')

    {!! BootForm::hidden('my_time')->value(Crypt::encrypt(time() - 60)) !!}
</div>
