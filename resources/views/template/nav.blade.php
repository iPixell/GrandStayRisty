<nav class="nav bg-dark d-flex align-items-center px-4 py-2 gap-4">
  <a href="{{ route('room') }}" class="text-decoration-none text-white fw-bold">GrandStay</a>

  @if(auth()->check())
    @if(auth()->user()->role == 'admin')
      <a href="{{ route('admin.rooms') }}" class="text-decoration-none text-white">Admin</a>
      <a href="{{ route('history') }}" class="text-decoration-none text-white">History</a>
    @else
      <a href="{{ route('room') }}" class="text-decoration-none text-white">Rooms</a>
      <a href="{{ route('history') }}" class="text-decoration-none text-white">History</a>
    @endif

    <span class="text-white ms-2">Halo, {{ auth()->user()->name }}</span>

    <form class="m-0 ms-auto" action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
  @else
    <a href="{{ route('login') }}" class="text-decoration-none text-white">Login</a>
    <a href="{{ route('register') }}" class="text-decoration-none text-white">Register</a>
  @endif
</nav>