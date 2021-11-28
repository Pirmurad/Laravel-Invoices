<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name', 'Laravel pdf') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .body {
            background: inherit;
            font-size: 14px;
        },
        .tbl-total {
            width: inherit;
            border: 0;
        }
        .tbl-total, .tbl-total tr, .tbl-total td {
            border: 0;
        }

    </style>
</head>

<body>
@yield('content')
</body>
</html>
