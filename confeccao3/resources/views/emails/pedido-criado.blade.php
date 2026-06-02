<!DOCTYPE html>
<html>
    <head><title>Confirmação de Pedido</title></head>
    <body>
        <h2>Olá {{ $pedido->cliente->nome }}!</h2>
        <p>Seu pedido foi registrado em nosso sistema.</p>
        <p><strong>Codigo de Ordem:</strong>#{{ $pedido->id }}</p>
        <p><strong>Valor total das Peças:</strong> R${{ number_format($pedido->valor_total, 2, ',', '.') }}</p>
        <p><strong>Status Atual:</strong> {{ $pedido->status }}</p>
        <hr>
        <small>Confeccao - seila... criatividade acabou</small>
    </body>
</html>


