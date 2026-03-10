<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-100">Redefinir Senha</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                {{ __('Enviar Link de Redefinição') }}
            </x-primary-button>
        </div>
        
        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">
                &larr; Voltar para o login
            </a>
        </p>
    </form>
</x-guest-layout>
