<div>
    <h2>Create Company</h2>

    <form method="post" wire:submit.prevent="submit" action="{{ route('companies.store') }}">
        {{ csrf_field() }}

        <div class="block">
            <label for="name"></label>
            <input type="text" name="name" id="name" wire:model="name"/>
        </div>
        @error('name')
        name is bad
        @enderror

        <div class="block">
            <label for="description"></label>
            <input type="text" name="description" id="description" wire:model="description"/>
        </div>
        @error('description')
        description is bad
        @enderror

        <div class="block">
            <label for="address"></label>
            <input type="text" name="address" id="address" wire:model="address"/>
        </div>
        @error('address')
        address is bad
        @enderror

        <input type="submit" value="Go!"/>
    </form>
</div>
