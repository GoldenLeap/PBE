<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clientes') }}
            </h2>
            <a href="{{ route('clientes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Novo Cliente
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
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Lista de Clientes</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gerencie os clientes cadastrados na plataforma.</p>
                    </div>
                    
                    <div class="overflow-x-auto border rounded-lg border-gray-200 dark:border-gray-700">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">Nome</th>
                                    <th scope="col" class="px-6 py-3 font-medium">CPF</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Telefone</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Email</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Endereço</th>
                                    <th scope="col" class="px-6 py-3 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($clientes as $cliente)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                        <td class="px-6 py-4">{{ $cliente->nome }}</td>
                                        <td class="px-6 py-4">{{ $cliente->cpf }}</td>
                                        <td class="px-6 py-4">{{ $cliente->telefone }}</td>
                                        <td class="px-6 py-4">{{ $cliente->email }}</td>
                                        <td class="px-6 py-4">{{ $cliente->endereco }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">Editar</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            Nenhum cliente cadastrado ainda.
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