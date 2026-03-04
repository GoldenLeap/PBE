<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Crie uma conta')" :description="__('Entre suas informações abaixo para criar sua conta')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input
                name="name"
                :label="__('Nome')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Nome Completo')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('Endereço de Email')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@email.com"
            />

            <flux:input
                name=""
                :label="__('Insira seu CPF')"
                type="text"
                required
                :placeholder="__('000.000.000-00')"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('Senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Senha')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('Confirme sua senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirme sua senha')"
                viewable
            />


            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Criar conta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Já possui uma conta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Entrar') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
