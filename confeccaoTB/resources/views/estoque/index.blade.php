<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Estoque') }}
            </h2>
            <a href="{{ route('estoque.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Registrar Item
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
                        <h3 class="text-lg font-medium">Gerenciamento de Estoque</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Controle de entrada e saída de mercadorias.</p>
                    </div>
                    
                    <div class="overflow-x-auto border rounded-lg border-gray-200 dark:border-gray-700">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">Produto</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Quantidade Disponível</th>
                                    <th scope="col" class="px-6 py-3 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($estoques as $estoque)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                        <td class="px-6 py-4 font-medium">{{ $estoque->nome_produto }}</td>
                                        <td class="px-6 py-4">
                                            @if($estoque->quantidade_estoque > 10)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                    {{ $estoque->quantidade_estoque }} unidades
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                    {{ $estoque->quantidade_estoque }} unidades
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right flex justify-end items-center space-x-2">
                                            <a href="{{ route('estoque.edit', $estoque) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">Editar</a>
                                            <form action="{{ route('estoque.destroy', $estoque->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold" onclick="return confirm('Tem certeza que deseja excluir este item do estoque?')">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            Nenhum item em estoque cadastrado.
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