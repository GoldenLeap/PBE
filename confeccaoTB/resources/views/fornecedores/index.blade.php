<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Fornecedores') }}
            </h2>
            <a href="{{ route('fornecedores.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Novo Fornecedor
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Lista de Fornecedores</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gerencie os fornecedores da sua confecção.</p>
                    </div>
                    
                    <div class="overflow-x-auto border rounded-lg border-gray-200 dark:border-gray-700">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">ID</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Nome</th>
                                    <th scope="col" class="px-6 py-3 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($fornecedores as $fornecedor)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                        <td class="px-6 py-4 font-medium">{{ str_pad($fornecedor->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="px-6 py-4">{{ $fornecedor->nome_fornecedor }}</td>
                                        <td class="px-6 py-4 text-right flex justify-end items-center space-x-2">
                                            <a href="{{ route('fornecedores.edit', $fornecedor) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">Editar</a>
                                            <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            Nenhum fornecedor cadastrado ainda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>