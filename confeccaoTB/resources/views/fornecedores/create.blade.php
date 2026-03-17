<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Novo Fornecedor') }}
            </h2>
            <a href="{{ route('fornecedores.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">Informações do Fornecedor</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Preencha os dados abaixo para cadastrar um novo fornecedor.</p>
                    </div>

                    <form action="{{ route('fornecedores.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome do Fornecedor -->
                            <div class="md:col-span-2">
                                <x-input-label for="nome_fornecedor" :value="__('Nome do Fornecedor')" />
                                <x-text-input id="nome_fornecedor" name="nome_fornecedor" type="text" class="mt-1 block w-full" :value="old('nome_fornecedor')" required autofocus placeholder="Ex: Tecidos Brasil Ltda." />
                                <x-input-error :messages="$errors->get('nome_fornecedor')" class="mt-2" />
                            </div>

                            <!-- CNPJ -->
                            <div>
                                <x-input-label for="cnpj" :value="__('CNPJ')" />
                                <x-text-input id="cnpj" name="cnpj" type="text" class="mt-1 block w-full" :value="old('cnpj')" required placeholder="00.000.000/0000-00" />
                                <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('fornecedores.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Salvar Fornecedor') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="module">
    $(function(){
        $('#cnpj').mask('AA.AAA.AAA/AAAA-00');
    });
</script>
