@extends('core::admin.master')

@section('title', __('New contact'))

@section('content')

    @include('core::admin._button-back', ['module' => 'contacts'])
    <h1>
        @lang('New contact')
    </h1>

    {!! BootForm::open()->action(route('admin::index-contacts'))->multipart()->role('form') !!}
        @include('contacts::admin._form')
    {!! BootForm::close() !!}

@endsection
