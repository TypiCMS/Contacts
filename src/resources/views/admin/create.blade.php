@extends('core::admin.master')

@section('title', __('New contact'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'contacts'])
        <h1 class="header-title">@lang('New contact')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-contacts'))->multipart()->role('form') !!}
        @include('contacts::admin._form')
    {!! BootForm::close() !!}

@endsection
