<header>
    <nav class="nav-container">
        <a class="logo" href="{{route('index')}}" style="display: block;
    float: left;">
            <img src="{{asset('images/logo.png')}}" style="width: 50px;
    height: 50px;">
        </a>
        <ul id="menu">
            @auth()
                <li><a href="{{route('profile')}}">Профиль</a></li>
                <li><a href="{{route('logout')}}">Выход</a>
            @endauth
            @guest()
                <li><a href="{{route('index')}}">Главная</a>
            @endguest
        </ul>
    </nav>
</header>

