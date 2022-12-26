<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DaniEasyCar') }}</title>

        <link href = "{{url('css/bootstrap.min.css')}}" rel = "stylesheet" >  

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>

      <style>       

        .bg-repeat{
          content: "";
          background-image: url({{asset('storage/fotos/Background-car.png')}});          
          opacity: 0.07;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          position: absolute;
          z-index: -1;
          background-repeat: repeat;
        }
      </style>

    </head>
    <body>
       
        <div class="bg-repeat"> </div>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
