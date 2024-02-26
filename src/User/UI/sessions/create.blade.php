<x-shared::app>
    <h1>login page</h1>

    <form method="POST" action="{{ route('sessions.store') }}">
        @csrf <!-- {{ csrf_field() }} -->

        <h2>Login</h2>
        <input type="email" name="email" id="email"/>
        <button>Login</button>
    </form>
</x-shared::app>
