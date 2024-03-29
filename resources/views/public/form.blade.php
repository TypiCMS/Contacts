@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contacts-form body-page body-page-' . $page->id)

@section('page')
    <div class="page-body">
        <div class="page-body-container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    @lang('message when errors in form')
                    .
                    <ul class="mb-0">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="@lang('Close')"></button>
                </div>
            @endif

            <div class="rich-content">{!! $page->present()->body !!}</div>

            {!! BootForm::open()->action(route($lang . '::store-contact'))->multipart() !!}

            @include('contacts::_fields')

            <div class="d-grid">
                <button class="btn-primary btn btn-lg" type="submit">{{ __('Send') }}</button>
            </div>

            {!! BootForm::close() !!}
        </div>
    </div>
@endsection
