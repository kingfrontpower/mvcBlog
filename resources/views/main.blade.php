<!DOCTYPE html>
<html lang="en">
    <head>    
        @include('partials._header')

    </head>
    <body>
        @include('partials._nav')

        @include('partials._messages')

        @yield('content')

        @include('partials._footer')

        @include('partials._javascript')

        @yield('myJavaScript')

    </body>
</html>