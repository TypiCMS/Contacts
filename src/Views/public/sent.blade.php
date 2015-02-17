@extends('core::public.master')

@section('main')

    <h2>{{ Illuminate\Support\Str::title(trans_choice('contacts::global.contacts', 1)) }}</h2>
    <div class="jubotron alert alert-success text-center">
        <h1>@lang('db.message when contact form is sent')</h1>
    </div>
@stop
