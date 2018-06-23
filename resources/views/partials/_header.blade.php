<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Laravel Blog @yield('title')</title> <!--CHANG THIS TITLE FOR EACH PAGE-->

<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

{{ Html::style('css/style.css') }}
<!--    <link rel="stylesheet" href="css/style.css">-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
    body{
        margin: 0;
        padding: 0;
/*        background-color: #e8b858;*/
        background-color: #e8b858;
    }
    .myBackgroundColor{
        background-color: #e59841;
    }

    
/*    custom-background-color*/
    .navbar-custom {
        background-color:#7aa04a;
        color:#ffffff;
        border-radius:0;
    }

    .navbar-custom .navbar-nav > li > a {
        color:#fff;
        padding-left:20px;
        padding-right:20px;
    }
    .navbar-custom .navbar-nav > .active > a, .navbar-nav > .active > a:hover, .navbar-nav > .active > a:focus {
        background-color: #6fb44e;
    }

    .navbar-custom .navbar-nav > li > a:hover, .nav > li > a:focus, .navbar-custom .navbar-nav .open>a  { 
        background-color: #6fb44e;
    }


    /* dropdown */
    .navbar-custom .navbar-nav .dropdown-menu  { 
        background-color: #6fb44e;
    }
    .navbar-custom .navbar-nav .dropdown-menu>li>a  { 
        color: #fff;
    }
    .navbar-custom .navbar-nav .dropdown-menu>li>a:hover,.navbar-custom .navbar-nav .dropdown-menu>li>a:focus  { 
        color: #6fb44e;
    }

    .navbar-custom .navbar-brand {
        color:#eeeeee;
    }
    .navbar-custom .navbar-toggle {
        background-color:#eeeeee;
    }
    .navbar-custom .icon-bar {
        background-color:#6fb44e;
    }
    /*    custom-background-color */
    
    
    
    footer{
        background-color: #67471f;
        color: #eee;
    }
    
    .text-deep-green{
        color: #4b5d28;
    }
</style>
@yield('myStyleSheet')
