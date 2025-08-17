@extends('core::admin.master')

@section('title', __('New contact'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-contacts'))->addClass('main-content') !!}
    @include('contacts::admin._form')
    {!! BootForm::close() !!}
@endsection
