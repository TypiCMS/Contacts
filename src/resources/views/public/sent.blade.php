@extends('core::public.master')

@section('main')

    <h1>@lang('contacts::global.name')</h1>

    <div class="jubotron alert alert-success text-center">
        <h1>@lang('db.message when contact form is sent')</h1>
    </div>

@stop
