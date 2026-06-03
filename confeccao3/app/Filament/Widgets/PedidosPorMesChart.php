<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;

class PedidosPorMesChart extends ChartWidget
{
    protected ?string $heading = 'Pedidos por Mês';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $meses = [];
        $pendentes = [];
        $emProducao = [];
        $finalizados = [];

        for ($i = 5; $i >= 0; $i--) {
            $data = now()->subMonths($i);
            $meses[] = $data->translatedFormat('M/Y');

            $pendentes[] = Pedido::where('status', 'Pendente')
                ->whereMonth('created_at', $data->month)
                ->whereYear('created_at', $data->year)
                ->count();

            $emProducao[] = Pedido::where('status', 'Em Produção')
                ->whereMonth('created_at', $data->month)
                ->whereYear('created_at', $data->year)
                ->count();

            $finalizados[] = Pedido::where('status', 'Finalizado')
                ->whereMonth('created_at', $data->month)
                ->whereYear('created_at', $data->year)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendentes',
                    'data' => $pendentes,
                    'backgroundColor' => 'rgba(251, 191, 36, 0.6)',
                    'borderColor' => 'rgb(251, 191, 36)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Em Produção',
                    'data' => $emProducao,
                    'backgroundColor' => 'rgba(96, 165, 250, 0.6)',
                    'borderColor' => 'rgb(96, 165, 250)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Finalizados',
                    'data' => $finalizados,
                    'backgroundColor' => 'rgba(74, 222, 128, 0.6)',
                    'borderColor' => 'rgb(74, 222, 128)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $meses,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
