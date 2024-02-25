<form method="POST">
    @csrf <!-- {{ csrf_field() }} -->

    <h2>Sign in</h2>
    <input type="email" name="email" id="email"/>
    <button>Sign in!</button>
</form>
