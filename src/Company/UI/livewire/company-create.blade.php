<section class="w-full">
    <div class="bg-tertiary m-8 p-8 rounded-3xl w-min justify-center mx-auto">

        <header class="my-4">
            <h1 class="text-2xl text-highlight">Create company</h1>
        </header>

        <form method="post" wire:submit.prevent="submit" action="{{ route('companies.store') }}">
            {{ csrf_field() }}

            <div class="my-4">
                <label for="name" class="text-highlight block text-sm font-medium leading-6">Name</label>
                <input type="text" class="bg-primary text-secondary p-1 rounded-md" name="name" id="name" wire:model="name"/>
            </div>
            @error('name')
            name is bad
            @enderror

            <div class="my-4">
                <label for="description" class="text-highlight block text-sm font-medium leading-6">Description</label>
                <input type="text" class="bg-primary text-secondary p-1 rounded-md" name="description" id="description" wire:model="description"/>
            </div>
            @error('description')
            description is bad
            @enderror

            <div class="my-4">
                <label for="address" class="text-highlight block text-sm font-medium leading-6">Address</label>
                <input type="text" class="bg-primary text-secondary p-1 rounded-md" name="address" id="address" wire:model="address"/>
            </div>
            @error('address')
            address is bad
            @enderror

            <input type="submit" value="Go!" class="bg-primary p-2 rounded text-highlight font-bold mt-4"/>
        </form>
    </div>
</section>
