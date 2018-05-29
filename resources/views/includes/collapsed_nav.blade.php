<li class="nav-item dropdown d-bock d-md-none mb-1 ml-5  mt-1" >
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
       aria-expanded="false">Menu</a>
    <div class="dropdown-menu">
        <a class="nav-link" href="{{ url("/pages/organisationen") }}">
            <img src="/icons/world.svg" height="20" class="navbar_icon"/> <br/>
            Organisationen
        </a>
        <a class="nav-link" href="{{ url("/pages/uber-uns") }}">
            <img src="/icons/abc.svg" height="20" class="navbar_icon"/> <br/>
            Über Uns
        </a>
        <a class="nav-link" href="{{ url("/pages/how_it_works") }}">
            <img src="/icons/wie-funktioniert.svg" height="20" class="navbar_icon"/> <br/>
            Wie es funktioniert
        </a>
        <!-- Authentication Links -->
        @guest
        <a class="nav-link" href="{{ route('login') }}">
            <img src="/icons/exit.svg" height="20" class="navbar_icon" /> <br/>
            Login
        </a>
        @else
            <a class="nav-link" href="{{ route('account') }}">
                <img src="/icons/account-r.svg" height="18" class="navbar_icon"/> <br/>
                Mein Konto
            </a>
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <img src="/icons/exit.svg" height="20" class="navbar_icon"/> <br/>
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
            @endguest
    </div>
</li>