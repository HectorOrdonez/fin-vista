<div>
    <h1>registration page</h1>

    <form method="post" wire:submit.prevent="submit" action="{{ route('users.store') }}">
        {{ csrf_field() }}

        <h2>Register</h2>
        <label for="email"></label>
        <input type="email" name="email" id="email" wire:model="email"/>
        @error('email')
        {{ $message }}
        @enderror
        <input type="submit" value="Go!"/>
    </form>
</div>
