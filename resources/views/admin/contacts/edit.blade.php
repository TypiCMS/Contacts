@extends('admin::core.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-contact', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('admin::contacts._form')
    {!! BootForm::close() !!}
@endsection
