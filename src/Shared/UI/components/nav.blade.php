<div class="bg-secondary/75 w-full h-24 block">
    <div class="sm:w-full md:w-9/12 lg:6/12 mx-auto flex flex-wrap items-center justify-between">
        <a href="{{ route('landing-page') }}" class="flex items-center">
            <img src="/logo.png" alt="Fin-Vista" aria-label="Fin-Vista" class="w-24 h-24">
            <span class="self-center text-2xl font-semibold text-highlight lg:ml-3 md:ml-1">Fin-Vista</span>
        </a>

        <div class="w-full md:block md:w-auto text-highlight font-semibold">
            <ul class="font-medium flex flex-col py-4 mt-4 md:flex-row sm:space-x-0 md:space-x-2 lg:space-x-8 md:mt-0 mr-8 md:mr-4">
                <li>
                    <a class="block py-2 md:p-0" href="{{ route('companies.create') }}">Add company</a>
                </li>
                <li>
                    <a class="block py-2 md:p-0" href="{{ route('companies.index') }}">See companies</a>
                </li>
                <li>
                    <a class="block py-2 md:p-0" href="{{ route('sessions.create') }}">Login</a>
                </li>
                <li>
                    <a class="block py-2 md:p-0" href="{{ route('users.create') }}">Register</a>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Unfortunately authentication does not work at the moment --}}
@auth
    <a href="{{ route('sessions.destroy') }}">Logout</a>
@endauth
@guest
    {{--    <a href="{{ route('companies.create') }}">Add company</a>--}}
    {{--    <a href="{{ route('sessions.create') }}">Login</a>--}}
    {{--    <a href="{{ route('users.create') }}">Register</a>--}}
@endguest
{{--<a href="{{ route('companies.index') }}">See companies</a>--}}
