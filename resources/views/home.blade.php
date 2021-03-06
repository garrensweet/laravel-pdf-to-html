<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PDF to HTML - Made Easy!</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

        <!-- Styles -->
        <link href="{{ secure_url('css/app.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="app"></div>

         <!-- Scripts -->
         <script src="{{ mix('js/main.js') }}"></script>
    </body>
</html>
