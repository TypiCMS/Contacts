@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contacts-form body-page body-page-'.$page->id)

@section('content')

    @if (!$errors->isEmpty())
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            @lang('db.message when errors in form').
            <ul class="mb-0">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rich-content">{!! $page->present()->body !!}</div>

    {!! BootForm::open()->action(route($lang.'::store-contact'))->multipart() !!}

    @include('contacts::_fields')

    <button class="btn-primary btn btn-block btn-lg" type="submit">{{ __('Send') }}</button>

    {!! BootForm::close() !!}

@endsection
