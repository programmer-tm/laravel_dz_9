<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Новостной блог</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                        <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Домой</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Войти</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" class="nav-link">Зарегистрироваться</a></li>
                        @endif
                @endauth class="nav-item"
            </ul>
        </div>
    </div>
</nav>