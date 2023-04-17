@extends('pages::public.master')

@section('bodyClass', 'body-contacts body-contact-sent body-page body-page-'.$page->id)

@section('page')

    <div class="page-body">

        <div class="page-body-container">

            <div class="rich-content">{!! $page->present()->body !!}</div>

            <p class="alert alert-success">@lang('message when contact form is sent')</p>

        </div>

    </div>

@endsection
