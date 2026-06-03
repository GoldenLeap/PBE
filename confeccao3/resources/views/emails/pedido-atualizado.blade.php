<!DOCTYPE html>
<html>
    <head><title>Atualização de Pedido</title></head>
    <body>
        <h2>Olá {{ $pedido->cliente->nome }}!</h2>
        <p>Seu pedido foi atualizado em nosso sistema.</p>
        <p><strong>Codigo de Ordem:</strong>#{{ $pedido->id }}</p>
        <p><strong>Valor total das Peças:</strong> R${{ number_format($pedido->valor_total, 2, ',', '.') }}</p>
        <p><strong>Status Atual:</strong> {{ $pedido->status }}</p>
        <p><strong>Quantidade Total de Peças:</strong> {{ $pedido->itens->sum('quantidade') }}</p>
        
        <h3>Itens do Pedido:</h3>
        <ul>
            @foreach($pedido->itens as $item)
                <li>{{ $item->quantidade }}x {{ $item->produto->nome }}</li>
            @endforeach
        </ul>
        <hr>
        <small>Confeccao - Atualização de pedido</small>
    </body>
</html>
