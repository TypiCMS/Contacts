@extends('core::public.master')

@section('main')

    <h2>{{ Illuminate\Support\Str::title(trans_choice('contacts::global.contacts', 1)) }}</h2>

    @if (! $errors->isEmpty())
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            @lang('db.message when errors in form').
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! BootForm::open()->action(route($lang . '.contacts.store'))->multipart()->role('form') !!}
    {!! BootForm::token() !!}
        
        {!! BootForm::hidden('language')->value($lang) !!}
        {!! Honeypot::getFormHTML('my_name', 'my_time') !!}
        
        <div class="row">

            <div class="col-sm-2">
                {!! BootForm::select('<span class="fa fa-asterisk"></span> ' . trans('validation.attributes.title'), 'title', ['' => '', 'mr' => trans('validation.attributes.mr'), 'mrs' => trans('validation.attributes.mrs')]) !!}
            </div>
            <div class="col-sm-5">
                {!! BootForm::text('<span class="fa fa-asterisk"></span> ' . trans('validation.attributes.first_name'), 'first_name') !!}
            </div>
            <div class="col-sm-5">
                {!! BootForm::text('<span class="fa fa-asterisk"></span> ' . trans('validation.attributes.last_name'), 'last_name') !!}
            </div>

        </div>

        {!! BootForm::email('<span class="fa fa-asterisk"></span> ' . trans('validation.attributes.email'), 'email') !!}
        {{-- BootForm::text(trans('validation.attributes.website'), 'website') --}}
        {{-- BootForm::text(trans('validation.attributes.company'), 'company') --}}
        {{-- BootForm::text(trans('validation.attributes.address'), 'address') --}}
        {{-- BootForm::text(trans('validation.attributes.postcode'), 'postcode') --}}
        {{-- BootForm::text(trans('validation.attributes.city'), 'city') --}}
        {{-- BootForm::text(trans('validation.attributes.country'), 'country') --}}
        {{-- BootForm::text(trans('validation.attributes.phone'), 'phone') --}}
        {{-- BootForm::text(trans('validation.attributes.mobile'), 'mobile') --}}
        {{-- BootForm::text(trans('validation.attributes.fax'), 'fax') --}}
        {!! BootForm::textarea('<span class="fa fa-asterisk"></span> ' . trans('validation.attributes.message'), 'message') !!}

        <div class="form-group">
            <span class="fa fa-asterisk"></span> @lang('global.Mandatory fields')
        </div>

        <button class="btn-primary btn btn-block btn-lg" type="submit">@lang('validation.attributes.send')</button>

    {!! BootForm::close() !!}

@stop
