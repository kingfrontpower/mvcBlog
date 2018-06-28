<!--       bootstrap basic nav-->
<!--<nav class="navbar navbar-default">-->
<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><span style="color: black;"><strong>官人我要</strong></span></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : ''  }}"><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;商品首頁</a></li>

                @if (Auth::check())
                <li><a href="{{ route('getOrderIndex')}}"><span class="glyphicon glyphicon-leaf"></span>&nbsp;檢視訂單</a></li> 
                @endif 
                @if( isset(Auth::user()->level) && (Auth::user()->level=="admin" || Auth::user()->level=="SP") )
                <li><a href="{{ route('orderAdmin')}}"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;大梨出貨單</a>
                </li><li><a href="{{ route('getTotalOrderAdmin')}}"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;管理員訂單總覽</a></li>  
                @endif
                <!--
<li class="{{ Request::is('blog') ? 'active' : ''  }}"><a href="{{ route('blog.index')}}">Blog</a></li>
<li class="{{ Request::is('about') ? 'active' : ''  }}"><a href="{{ route('about')}}">About</a></li>
<li class="{{ Request::is('contact') ? 'active' : ''  }}"><a href="{{ route('contact')}}">Contact</a></li>
-->
            </ul>
            <!--
<form class="navbar-form navbar-left">
<div class="form-group">
<input type="text" class="form-control" placeholder="Search">
</div>
<button type="submit" class="btn btn-default">Submit</button>
</form>
-->
            <ul class="nav navbar-nav navbar-right">
                <!--                        <li><a href="#">Link</a></li>-->

                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;Hello {{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">

                        <li><a href="{{ route('logout')}}">登出</a></li>
                    </ul>
                </li>

                @else

                <a href="{{ route('login') }}" class='btn btn-default nav-btn-spacing' >登入 </a>

                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>