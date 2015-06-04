@extends('pages::public.master')
@inject('page', 'typicms.contacts.page')

@section('bodyClass', 'body-contacts body-contact-sent body-page body-page-' . $page->id)

@section('main')

    {!! $page->body !!}

    <div class="jubotron alert alert-success text-center">
        <h1>@lang('db.message when contact form is sent')</h1>
    </div>

@stop
