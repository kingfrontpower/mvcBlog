<!DOCTYPE html>
<html lang="en">
    <head>    
        @include('partials._header')

    </head>
    <body>
        @include('partials._nav')
        
        @include('partials._messages')
         
        <div class="container">           

            @yield('content')

        </div><!-- end of container -->


        @include('partials._footer')

        @include('partials._javascript')

        @yield('myJavaScript')

    </body>
</html>