<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Novo Produto') }}
            </h2>
            <a href="{{ route('produtos.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Informações do Produto</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Preencha os dados abaixo para cadastrar um novo produto.</p>
                    </div>

                    <form action="{{ route('produtos.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome do Produto -->
                            <div class="md:col-span-2">
                                <x-input-label for="nome_produto" :value="__('Nome do Produto')" />
                                <x-text-input id="nome_produto" name="nome_produto" type="text" class="mt-1 block w-full" :value="old('nome_produto')" required autofocus placeholder="Ex: Camiseta Básica" />
                                <x-input-error :messages="$errors->get('nome_produto')" class="mt-2" />
                            </div>

                            <!-- Descrição -->
                            <div class="md:col-span-2">
                                <x-input-label for="descricao_produto" :value="__('Descrição')" />
                                <textarea id="descricao_produto" name="descricao_produto" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Descreva o produto...">{{ old('descricao_produto') }}</textarea>
                                <x-input-error :messages="$errors->get('descricao_produto')" class="mt-2" />
                            </div>

                            <!-- Preço -->
                            <div>
                                <x-input-label for="preco_produto" :value="__('Preço (R$)')" />
                                <x-text-input id="preco_produto" name="preco_produto" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('preco_produto')" required placeholder="0,00" />
                                <x-input-error :messages="$errors->get('preco_produto')" class="mt-2" />
                            </div>

                            <!-- Quantidade -->
                            <div>
                                <x-input-label for="quantidade_produto" :value="__('Quantidade em Estoque')" />
                                <x-text-input id="quantidade_produto" name="quantidade_produto" type="number" min="0" class="mt-1 block w-full" :value="old('quantidade_produto')" required placeholder="0" />
                                <x-input-error :messages="$errors->get('quantidade_produto')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('produtos.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Salvar Produto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
