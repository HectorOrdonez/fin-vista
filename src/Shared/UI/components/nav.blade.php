@auth
    <a href="{{ route('sessions.destroy') }}">Logout</a>
@endauth
@guest
    {{--
        Adding company should be only for auth users
        Unfortunately authentication does not work at the moment
     --}}
    <a href="{{ route('companies.create') }}">Add company</a>

    <a href="{{ route('sessions.create') }}">Login</a>
    <a href="{{ route('users.create') }}">Register</a>
@endguest

<a href="{{ route('companies.index') }}">See companies</a>
