<nav id="nav">
    <form id="form-logout" method="POST" action="{{ url('/logout') }}" style="display: none">
        @csrf
    </form>
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
        @guest
        <li><a href="{{ url('/login') }}">{{__('web.signin')}}</a></li>
        <li><a href="{{ url('/register') }}">{{__('web.signup')}}</a></li>
        @endguest

        @auth
        <li><a id="logout-link" href="{{ url('#') }}">{{__('web.signout')}}</a></li>
        @if (Auth::user()->role->name == "student")
        <li><a  href="{{ url('/profile') }}">{{__('web.profile')}}</a></li>
        @else
        <li><a  href="{{ url('/dashboard/home') }}">{{__('web.dashboard')}}</a></li>
        @endif
        @endauth

        @if (App::getLocale()=='ar')
        <li><a href="{{ url('lang/set/en') }}">EN</a></li>
        @else
        <li><a href="{{ url('lang/set/ar') }}">العربية</a></li>
        @endif
    </ul>
</nav>