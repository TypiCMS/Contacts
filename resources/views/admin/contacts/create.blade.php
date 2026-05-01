<x-core::layouts.admin :title="__('New contact')">
    {!!
        BootForm::open()
            ->action(route('admin::index-contacts'))
            ->addClass('form')
    !!}
    @include('admin::contacts._form')
    {!! BootForm::close() !!}
</x-core::layouts.admin>
