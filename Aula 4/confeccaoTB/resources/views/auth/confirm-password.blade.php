<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Área Segura</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Esta é uma área segura. Por favor, confirme sua senha antes de continuar.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
