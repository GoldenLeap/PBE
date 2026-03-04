<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight">
                {{ __('Clientes') }}
            </h2>
            <x-primary-button>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Novo Cliente
            </x-primary-button>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Tabela Modernizada -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden relative z-0">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Lista de Clientes</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Gerencie os clientes cadastrados na plataforma.</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left align-middle">
                    <thead class="text-xs uppercase bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700 font-semibold tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-4 rounded-tl-xl">Nome</th>
                            <th scope="col" class="px-6 py-4">CPF</th>
                            <th scope="col" class="px-6 py-4">Telefone</th>
                            <th scope="col" class="px-6 py-4 rounded-tr-xl text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($clientes as $cliente)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold text-xs shrink-0">
                                            {{ substr($cliente->nome, 0, 1) }}
                                        </div>
                                        {{ $cliente->nome }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $cliente->cpf }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $cliente->telefone }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors">
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                        </svg>
                                        <p class="text-sm font-medium">Nenhum cliente cadastrado ainda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>