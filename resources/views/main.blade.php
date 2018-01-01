<!DOCTYPE html>
<html lang="en">
    <head>    
        @include('partials._header')
    </head>
    <body>
        @include('partials._nav')
        <div class="container">

            @yield('content')

            <hr />
        </div><!-- end of container -->


        @include('partials._footer')

        @include('partials._javascript')

        @yield('myJavaScript')

    </body>
</html>