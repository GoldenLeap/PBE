<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Receita Total</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">R$ 0,00</div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">sem dados anteriores</div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Pedidos Ativos</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">0</div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">sem dados anteriores</div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Produtos Vendidos</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">0</div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">sem dados anteriores</div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Clientes Ativos</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">0</div>
                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">sem dados anteriores</div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-medium">Recent Transactions</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Latest orders and their current status.</p>
                    </div>
                    <a href="#" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                        View All
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-medium">Invoice</th>
                                <th scope="col" class="px-6 py-3 font-medium">Client</th>
                                <th scope="col" class="px-6 py-3 font-medium">Amount</th>
                                <th scope="col" class="px-6 py-3 font-medium">Status</th>
                                <th scope="col" class="px-6 py-3 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Nenhuma transação recente encontrada.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
