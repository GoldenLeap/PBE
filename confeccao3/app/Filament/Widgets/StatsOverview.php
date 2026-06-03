<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $totalPedidos = Pedido::count();
        $pedidosPendentes = Pedido::where('status', 'Pendente')->count();
        $pedidosFinalizados = Pedido::where('status', 'Finalizado')->count();
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();
        $faturamento = Pedido::where('status', 'Finalizado')->sum('valor_total');

        // Sparkline dos últimos 7 meses de pedidos finalizados
        $pedidosPorMes = [];
        for ($i = 6; $i >= 0; $i--) {
            $pedidosPorMes[] = Pedido::where('status', 'Finalizado')
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->whereYear('created_at', now()->subMonths($i)->year)
                ->count();
        }

        return [
            Stat::make('Total de Pedidos', $totalPedidos)
                ->description("{$pedidosPendentes} pendentes")
                ->descriptionIcon('heroicon-m-clock')
                ->chart($pedidosPorMes)
                ->chartColor('primary'),

            Stat::make('Pedidos Finalizados', $pedidosFinalizados)
                ->description('Concluídos com sucesso')
                ->descriptionIcon('heroicon-m-check-circle')
                ->chartColor('success'),

            Stat::make('Faturamento', 'R$ ' . number_format($faturamento, 2, ',', '.'))
                ->description('Pedidos finalizados')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->chartColor('warning'),

            Stat::make('Clientes Cadastrados', $totalClientes)
                ->description("{$totalProdutos} produtos no catálogo")
                ->descriptionIcon('heroicon-m-users')
                ->chartColor('info'),
        ];
    }
}
