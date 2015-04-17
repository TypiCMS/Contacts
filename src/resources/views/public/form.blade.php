@extends('core::public.master')

@section('title', trans('contacts::global.name') . ' – ' . $websiteTitle)
@section('ogTitle', trans('contacts::global.name'))

@section('main')

    <h1>@lang('contacts::global.name')</h1>

    @if (! $errors->isEmpty())
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

    {!! BootForm::open()->action(route($lang . '.contacts.store'))->multipart()->role('form') !!}
    {!! BootForm::token() !!}

    @include('contacts::_fields')

    <button class="btn-primary btn btn-block btn-lg" type="submit">@lang('validation.attributes.send')</button>

    {!! BootForm::close() !!}

@stop
