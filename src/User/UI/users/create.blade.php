<h1>registration page</h1>

<form method="POST" action="{{ route('users.store') }}">
    @csrf <!-- {{ csrf_field() }} -->

    <h2>Register</h2>
    <input type="email" name="email" id="email"/>
    <button>Register</button>
</form>

