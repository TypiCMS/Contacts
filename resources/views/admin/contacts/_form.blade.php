<x-core::header
    :$model
    :back-url="$model->indexUrl()"
    :back-label="__('Contacts')"
    :default-title="__('New contact')"
    :lang-switcher="false"
    :preview="false"
/>

<div class="form-body">
    @include('public::contacts._fields')
</div>
