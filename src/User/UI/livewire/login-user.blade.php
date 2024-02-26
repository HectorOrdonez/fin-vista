<section class="w-full">
    <div class="bg-tertiary m-8 p-8 rounded-3xl w-min justify-center mx-auto">
        <header class="my-4">
            <h1 class="text-2xl text-highlight">Login</h1>
        </header>

        <form method="post" wire:submit.prevent="submit" action="{{ route('sessions.store') }}">
            @csrf <!-- {{ csrf_field() }} -->

            <div class="my-4">
                <label for="email" class="text-highlight block text-sm font-medium leading-6">Email</label>
                <input type="text" class="bg-primary text-secondary p-1 rounded-md" name="email" id="email" wire:model="email"/>
            </div>
            @error('email')
            <div class="text-red-700">{{ $message }}</div>
            @enderror
            <input type="submit" value="Go!" class="bg-primary p-2 rounded text-highlight font-bold mt-4"/>
        </form>
    </div>
</section>
