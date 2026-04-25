@extends('admin::core.master')

@section('title', __('New contact'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-contacts'))->addClass('form') !!}
    @include('admin::contacts._form')
    {!! BootForm::close() !!}
@endsection
