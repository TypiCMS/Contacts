@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contact-sent body-page body-page-'.$page->id)

@section('content')

    {!! $page->body !!}

    <p class="alert alert-success">@lang('db.message when contact form is sent')</p>

@endsection
