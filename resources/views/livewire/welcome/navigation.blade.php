<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @auth
        <a wire:navigate href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
    @else
        <a wire:navigate href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Entrar</a>
        <a wire:navigate href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrar</a>
    @endauth
</div>
