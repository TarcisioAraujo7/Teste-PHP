<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css">
        
    </head>
    <body>
        <header class="cabeçalho">

            <div class="dropdown">
                <button class="header-button">Clientes</button>
                <div class="dropdown-content">
                    <a class="ancora" href="/clients/">Ler</a>
                    <a class="ancora" href="/clients/cadastrar/">Inserir</a>
                    <a class="ancora" href="/clients/atualizar/">Modificar</a>
                    <a class="ancora" href="/clients/deletar/">Deletar</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="header-button">Produtos</button>
                <div class="dropdown-content">
                    <a class="ancora" href="/products/">Ler</a>
                    <a class="ancora" href="/products/cadastrar/">Inserir</a>
                    <a class="ancora" href="/products/atualizar/">Modificar</a>
                    <a class="ancora" href="/products/deletar/">Deletar</a>
                    <a class="ancora" href="/products/promo/">Aplicar descontos</a>

                </div>
            </div>
            <div class="dropdown">
                <button class="header-button">Pedidos</button>
                <div class="dropdown-content">
                    <a class="ancora" href="/orders/">Ler</a>
                    <a class="ancora" href="/orders/cadastrar/">Inserir</a>
                    <a class="ancora" href="/orders/atualizar/">Modificar</a>
                    <a class="ancora" href="/orders/deletar/">Deletar</a>
                </div>
            </div>
            
        </header>
        <script src="script.js"></script>
        <main class="principal">
            
        @yield('content')
        </main>
    </body>
</html>
