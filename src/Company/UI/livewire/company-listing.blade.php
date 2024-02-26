<section class="w-full">
    <header class="mt-8 mb-2 text-center">
        <h1 class="text-2xl text-highlight">Company listing</h1>
    </header>

    <div class="grid gap-4 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">

        @foreach($companies as $company)
            <div class="block bg-tertiary m-8 p-8 rounded-3xl">
                <div class="font-bold text-highlight">Name:</div>
                <div class="text-highlight/80">{{ $company['name'] }}</div>
                <div class="font-bold text-highlight">Description:</div>
                <div class="text-highlight/80">The famous guys</div>
                <div class="font-bold text-highlight">Address:</div>
                <div class="text-highlight/80"> bla 12</div>
                <div class="font-bold text-highlight">Industry:</div>
                <div class="text-highlight/80">Weapons</div>
                <div class="font-bold text-highlight">Currency:</div>
                <div class="text-highlight/80">EUR</div>
                <div class="font-bold text-highlight">Dividend per share:</div>
                <div class="text-highlight/80">3213.23</div>
                <div class="font-bold text-highlight">Last 50 days moving average:</div>
                <div class="text-highlight/80">123.2</div>
            </div>
        @endforeach

    </div>
</section>
