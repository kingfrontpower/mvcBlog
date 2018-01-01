<!DOCTYPE html>
<html lang="en">
    <head>    
        @include('partials._header')
    </head>
    <body>
        @include('partials._nav')
        <div class="container">

            @yield('content')

        </div><!-- end of container -->
        <hr />

        @include('partials._footer')

        @include('partials._javascript')

        @yield('myJavaScript')

    </body>
</html>