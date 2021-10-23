<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">
            @if (Auth::user()->access_lvl == 1)
                Cliente: {{Auth::user()->name}} </span>
            @else
                Funcionário: {{Auth::user()->name}} </span>
            @endif
      </a>

      @if (Auth::user()->access_lvl == 1)

        <ul class="nav nav-pills">
          <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link" aria-current="page">Início</a></li>
          <li class="nav-item"><a href="{{route('request.list')}}" class="nav-link">Pedidos</a></li>
          <li class="nav-item"><a href="{{route('user.show')}}" class="nav-link">Dados</a></li>
          <li class="nav-item"><a href="{{route('auth.logout')}}" class="nav-link">Logout</a></li>
        </ul>
          
      @else

        <ul class="nav nav-pills">
          <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link" aria-current="page">Início</a></li>
          <li class="nav-item"><a href="{{route('request.list')}}" class="nav-link">Pedidos</a></li>
          <li class="nav-item"><a href="{{url('/crud_products')}}" class="nav-link">Produtos</a></li>
          <li class="nav-item"><a href="{{route("user.list")}}" class="nav-link">Usuários</a></li>
          <li class="nav-item"><a href="{{route('user.show')}}" class="nav-link">Dados</a></li>
          <li class="nav-item"><a href="{{route('auth.logout')}}" class="nav-link">Logout</a></li>
        </ul>
          
      @endif
      
</header>