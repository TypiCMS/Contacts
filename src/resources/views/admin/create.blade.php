@extends('core::admin.master')

@section('title', trans('contacts::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'contacts'])
    <h1>
        @lang('contacts::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-contacts'))->multipart()->role('form') !!}
        @include('contacts::admin._form')
    {!! BootForm::close() !!}

@endsection
