<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>
    {{-- <!-- css include --> --}}
        {{-- <!-- normalize  --> --}}
        <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
        {{-- <!-- end normalize  --> --}}
        {{-- <!-- fonts  --> --}}
        <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
        {{-- <!-- end fonts  --> --}}
        {{-- <!-- bootstrap-grid  --> --}}
        <link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
        {{-- <!-- end bootstrap-grid --> --}}
        {{-- <!-- fontawesome-p-5 --> --}}
        <link rel="stylesheet" href="{{asset('fontawesome-p-5.13/css/all.min.css')}}">
        {{-- <!-- fontawesome-p-5  --> --}}
        {{-- <!-- main  --> --}}
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        {{-- <!-- end main  --> --}}
        @yield('customCSS')
    {{-- <!-- end css include  --> --}}
</head>
<body>
 @yield('content')
    {{-- <!-- js include  --> --}}
        {{-- <!-- jquery  --> --}}
        <script src="{{asset('js/jQuery/jquery-3.6.0.min.js')}}"></script>
        {{-- <!-- end jquery  --> --}}
        {{-- <!-- main  --> --}}
        <script src="{{asset('js/main.js')}}"></script>
        {{-- <!-- end main  --> --}}
        @yield('customJS')
    {{-- <!-- end js include  --> --}}
</body>
</html>