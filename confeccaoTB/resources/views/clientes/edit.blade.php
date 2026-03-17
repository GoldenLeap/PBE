<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Cliente') }}
            </h2>
            <a href="{{ route('clientes.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition-all text-sm gap-2">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-white dark:text-gray-100">Informações do Cliente</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Atualize os dados do cliente abaixo.</p>
                    </div>

                    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome -->
                            <div class="md:col-span-2">
                                <x-input-label for="nome" :value="__('Nome Completo')" />
                                <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome', $cliente->nome)" required autofocus placeholder="Ex: João da Silva"/>
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>

                            <!-- CPF -->
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input id="cpf" name="cpf" type="text" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed" :value="old('cpf', $cliente->cpf)" readonly placeholder="000.000.000-00" />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('E-mail')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $cliente->email)" required placeholder="exemplo@email.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Telefone -->
                            <div class="md:col-span-2">
                                <x-input-label for="telefone" :value="__('Telefone')" />
                                <x-text-input id="telefone" name="telefone" type="text" class="mt-1 block w-full md:w-1/2" :value="old('telefone', $cliente->telefone)" required placeholder="(00) 00000-0000" />
                                <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                            </div>

                            <!-- Endereço -->
                            <div class="md:col-span-2">
                                <x-input-label for="endereco" :value="__('Endereço (Opcional)')" />
                                <textarea id="endereco" name="endereco" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Rua, número, bairro, cidade - estado">{{ old('endereco', $cliente->endereco) }}</textarea>
                                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('clientes.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition-all">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Atualizar Cliente') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script type="module">
    $(function(){
        var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
        $("#cpf").mask('000.000.000-00')
        $("#telefone").mask(SPMaskBehavior, spOptions)
    })
</script>
@endpush
