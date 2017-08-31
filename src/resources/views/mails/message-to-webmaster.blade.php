<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
    </head>

    <body>

        <a href="{{ url('/') }}">
            @if (TypiCMS::hasLogo())
                @include('core::public._logo')
            @endif
        </a>

        <h2>@lang('New contact request from') {{ $model->first_name }} {{ $model->last_name }}</h2>

        <p><a class="btn btn-primary" href="{{ route('admin::edit-contact', $model->id) }}">@lang('View online')</a></p>

        @include('contacts::mails._detail', ['model' => $model])

    </body>

</html>
