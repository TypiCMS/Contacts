<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
    </head>

    <body>

        <a href="{{ url('/') }}">
            {!! TypiCMS::logo() !!}
        </a>

        <h2>@lang('contacts::global.Thank you for your contact request')</h2>

        @include('registrations::mails._detail', ['model' => $model])

        <hr>

        {{ Blocks::build('signature-mail') }}

    </body>

</html>
