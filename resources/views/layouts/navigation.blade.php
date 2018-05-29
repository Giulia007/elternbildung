<nav class="navbar-expand-md navbar-light">
    <a href="{{ url("/") }}" class="navbar-brand">
        <img
            src="{{ asset('images/Logo_Elternbildung-Portal.svg') }}"
            width="300"
            alt="logo">
    </a>


    @include('includes.collapsed_nav')

    <div class="d-none d-md-block ml-auto">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url("/pages/organisationen") }}">
                    <img src="/icons/world.svg" height="20"/> <br/>
                    Organisationen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url("/pages/uber-uns") }}">
                    <img src="/icons/abc.svg" height="20"/> <br/>
                    Über Uns
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url("/pages/wie-funktionierts") }}">
                    <img src="/icons/wie-funktioniert.svg" height="20"/> <br/>
                    Wie es funktioniert
                </a>
            </li>
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <img src="/icons/exit.svg" height="20"/> <br/>
                    Login
                </a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account') }}">
                        <img src="/icons/account-r.svg" height="18"/> <br/>
                        Mein Konto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <img src="/icons/exit.svg" height="20"/> <br/>
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest
        </ul>
    </div>
</nav>