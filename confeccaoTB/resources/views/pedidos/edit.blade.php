<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Pedido') }}
            </h2>
            <a href="{{ route('pedidos.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Informações do Pedido</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Atualize os dados do pedido.</p>
                    </div>

                    <form action="{{ route('pedidos.update', $pedido) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Número do Pedido -->
                            <div>
                                <x-input-label for="num_pedido" :value="__('Número do Pedido')" />
                                <x-text-input id="num_pedido" name="num_pedido" type="number" min="1" class="mt-1 block w-full" :value="old('num_pedido', $pedido->num_pedido)" required autofocus placeholder="Ex: 1001" />
                                <x-input-error :messages="$errors->get('num_pedido')" class="mt-2" />
                            </div>

                            <!-- Nome do Cliente -->
                            <div>
                                <x-input-label for="nome_cliente" :value="__('Nome do Cliente')" />
                                <x-text-input id="nome_cliente" name="nome_cliente" type="text" class="mt-1 block w-full" :value="old('nome_cliente', $pedido->nome_cliente)" required placeholder="Ex: João da Silva" />
                                <x-input-error :messages="$errors->get('nome_cliente')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('pedidos.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Salvar Pedido') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
