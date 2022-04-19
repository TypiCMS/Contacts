@extends('core::admin.master')

@section('title', __('New contact'))

@section('content')

    {!! BootForm::open()->action(route('admin::index-contacts'))->multipart()->role('form') !!}
        @include('contacts::admin._form')
    {!! BootForm::close() !!}

@endsection
