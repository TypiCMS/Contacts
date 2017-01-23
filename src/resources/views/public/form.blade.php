@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contacts-form body-page body-page-'.$page->id)

@section('content')

    @if (!$errors->isEmpty())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @lang('db.message when errors in form').
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! $page->body !!}

    {!! BootForm::open()->action(route($lang.'::store-contact'))->multipart() !!}

    @include('contacts::_fields')

    <button class="btn-primary btn btn-block btn-lg" type="submit">{{ __('Send') }}</button>

    {!! BootForm::close() !!}

@endsection
