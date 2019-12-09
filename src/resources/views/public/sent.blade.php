@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contact-sent body-page body-page-'.$page->id)

@section('content')

    <div class="site-content">

        <div class="rich-content">{!! $page->present()->body !!}</div>

        <p class="alert alert-success">@lang('db.message when contact form is sent')</p>

    </div>

@endsection
