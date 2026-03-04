<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 dark:text-white tracking-tight">
                {{ __('Estoque') }}
            </h2>
            <x-primary-button>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Registrar Movimento
            </x-primary-button>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden relative z-0">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Gerenciamento de Estoque</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Controle de entrada e saída de mercadorias.</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left align-middle">
                    <thead class="text-xs uppercase bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700 font-semibold tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-4 rounded-tl-xl">Produto</th>
                            <th scope="col" class="px-6 py-4">Quantidade Disponível</th>
                            <th scope="col" class="px-6 py-4 rounded-tr-xl text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @forelse ($estoques as $estoque)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors group">
                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-sky-50 dark:bg-sky-500/10 flex items-center justify-center text-sky-600 dark:text-sky-400 font-bold text-xs shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="m19 21-4-16-4 16"/><path d="M11 21V9l-4 12"/></svg>
                                        </div>
                                        {{ $estoque->nome_produto }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium {{ $estoque->quantidade_estoque > 10 ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800' : 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-800' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $estoque->quantidade_estoque > 10 ? 'bg-emerald-600 dark:bg-emerald-400' : 'bg-red-600 dark:bg-red-400' }}"></span>
                                        {{ $estoque->quantidade_estoque }} unidades
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/20 transition-colors">
                                <td colspan="3" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                                        </svg>
                                        <p class="text-sm font-medium">Nenhum item em estoque cadastrado.</p>
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