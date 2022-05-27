<nav id="nav">
    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href="{{ url('/') }}">{{__('web.home')}}</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">{{__('web.cats')}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach ($cats as  $cat)
                <li><a href="{{ url("category/show/{$cat->id}") }}">{{ $cat->name() }}</a></li>
                @endforeach
                
            </ul>
        </li>
        <li><a href="{{ url('contact') }}">  {{__('web.contact')}}  </a></li>
        <li><a href="login.html">{{__('web.signin')}}</a></li>
        <li><a href="register.html">{{__('web.signup')}}</a></li>
        @if (App::getLocale()=='ar')
        <li><a href="{{ url('lang/set/en') }}">EN</a></li>
        @else
        <li><a href="{{ url('lang/set/ar') }}">العربية</a></li>
        @endif
    </ul>
</nav>