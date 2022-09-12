<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>exv</title>
        @vite('resources/css/app.css')
    </head>
    <body class="">
        <div id="app">

        </div>
        <h2 class="underline"> here </h2>
        @vite('resources/js/app.js')
    </body>
</html>
