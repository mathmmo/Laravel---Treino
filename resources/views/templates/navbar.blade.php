<nav id="navbar-left-screen">
    <ul class="sidebar-menu">
        <li><i class="fas fa-user-astronaut"></i></li>
        <li><h3 class="user-name">{{ Auth::user()->name }}</h3></li>
        @can('isAdmin')
        <li><a href="{{ route('pending.index')}}">
            <h3>Pendente</h3>
        </a></li>
        <li><a href="{{ route('aproved.index')}}">
            <h3>Aprovado</h3>
        </a></li>
        @endcan
        @can('isUser')
        <li><a href="{{ route('type.index')}}">
            <h3>Cadastro de Tipos</h3>
        </a></li>
        <li><a href="{{ route('request.index')}}">
            <h3>Requisições de Reembolso</h3>
        </a></li>
        @endcan
    </ul>
    <!-- <ul class="logout-btn">
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul> -->
</nav>