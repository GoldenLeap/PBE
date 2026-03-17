<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Pedidos') }}
            </h2>
            <a href="{{ route('pedidos.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                + Novo Pedido
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
                        <h3 class="text-lg font-medium">Lista de Pedidos</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gerencie os pedidos recebidos na plataforma.</p>
                    </div>

                    <div class="overflow-x-auto border rounded-lg border-gray-200 dark:border-gray-700">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">Nº Pedido</th>
                                    <th scope="col" class="px-6 py-3 font-medium">Cliente</th>
                                    <th scope="col" class="px-6 py-3 font-medium text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($pedidos as $pedido)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/20">
                                        <td class="px-6 py-4 font-medium">
                                            #{{ str_pad($pedido->num_pedido ?? $pedido->id, 5, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4">{{ $pedido->nome_cliente }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('pedidos.edit', $pedido) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium">Editar</a>
                                            <form id="del-{{ $pedido->id }}" action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" onclick="openDeleteModal('del-{{ $pedido->id }}', 'Pedido de {{ addslashes($pedido->nome_cliente) }}')" class="text-red-500 hover:text-red-700 text-sm font-semibold ml-2">
                                                Excluir
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            Nenhum pedido cadastrado ainda.
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

    <!-- Modal de Confirmação -->
    <div id="delete-modal" style="display:none; position:fixed; inset:0; z-index:9999; align-items:center; justify-content:center;">
        <div onclick="closeDeleteModal()" style="position:fixed; inset:0; background:rgba(0,0,0,0.5);"></div>
        <div style="position:relative; background:white; border-radius:12px; padding:24px; width:100%; max-width:400px; margin:0 16px; box-shadow:0 20px 60px rgba(0,0,0,0.3);">
            <div style="text-align:center; margin-bottom:16px;">
                <div style="display:inline-flex; align-items:center; justify-content:center; width:48px; height:48px; border-radius:50%; background:#fee2e2; margin-bottom:12px;">
                    <svg width="24" height="24" fill="none" stroke="#dc2626" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                </div>
                <h3 style="font-size:18px; font-weight:600; color:#111; margin-bottom:8px;">Confirmar Exclusão</h3>
                <p id="delete-modal-name" style="font-size:15px; font-weight:600; color:#111; margin-bottom:4px;"></p>
                <p style="font-size:14px; color:#6b7280;">Tem certeza que deseja excluir este pedido? Esta ação não poderá ser desfeita.</p>
            </div>
            <div style="display:flex; justify-content:center; gap:12px; margin-top:20px;">
                <button onclick="closeDeleteModal()" style="padding:8px 20px; border-radius:8px; border:1px solid #d1d5db; background:#f9fafb; color:#374151; font-size:14px; cursor:pointer;">
                    Cancelar
                </button>
                <button onclick="confirmDelete()" style="padding:8px 20px; border-radius:8px; border:none; background:#dc2626; color:white; font-size:14px; font-weight:600; cursor:pointer;">
                    Sim, Excluir
                </button>
            </div>
        </div>
    </div>

    <script>
        var pendingDeleteFormId = null;

        function openDeleteModal(formId, name) {
            pendingDeleteFormId = formId;
            document.getElementById('delete-modal-name').textContent = name || '';
            document.getElementById('delete-modal').style.display = 'flex';
        }

        function closeDeleteModal() {
            pendingDeleteFormId = null;
            document.getElementById('delete-modal').style.display = 'none';
        }

        function confirmDelete() {
            if (pendingDeleteFormId) {
                document.getElementById(pendingDeleteFormId).submit();
            }
        }
    </script>
</x-app-layout>