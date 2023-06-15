@extends('layouts.main')

@section('title', 'Confirme o desconto')
@section('content')
<div class=viewer>
        
    <h1>Confirme a alteração do produto!</h1>
        
    <div class=form_view>

        <br><h2>Produto do ID:{{ $product->id_product }}</h2>

        <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Valor Unitário</th>
                        <th>Codigo de barras</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>{{ $product->id_product }}</td>
                        <td>{{ $product->name_product }}</td>
                        <td>R${{ $product->unitary_value }}</td>
                        <td>{{ $product->bar_code }}</td>
                    </tr>
                    
                </tbody>

        </table>

        <form method="POST" action="/products/promo/{{ $product->id_product }}">
            @csrf
            @method('PUT')
            <div>
                
                <label for="title">Valor atual:</label>
                <span class="input-group-text">R$</span>
                <input type="number" min="0" step="0.01" class="form-control" id="unitary_value" name="unitary_value" placeholder="Valor unitário" value="{{$product->unitary_value}}" readonly>

                <label for="title">Desconto em %:</label>
                <input type="number" min="0" max="60" step="0.01" class="form-control" id="discount" name="discount" placeholder="Desconto em %" >

                <label for="title">Valor final:</label>
                <span class="input-group-text">R$</span>
                <input type="number" min="0.01" step="0.01" class="form-control" id="final_value" name="final_value" placeholder="Valor final" readonly>
        

                <br><button type="submit" class="btn-ok">Confirmar alteração</button>
            </div>

        </form>

        <script>
            // Obtém os elementos do DOM
            const unitaryValueInput = document.getElementById('unitary_value');
            const discountInput = document.getElementById('discount');
            const finalValueInput = document.getElementById('final_value');
        
            // Atualiza o valor final quando o desconto for alterado
            discountInput.addEventListener('input', () => {
            const unitaryValue = parseFloat(unitaryValueInput.value);
            const discount = parseFloat(discountInput.value);
        
            // Calcula o valor final com base no desconto
            const finalValue = unitaryValue - (unitaryValue * (discount / 100));
        
            // Exibe o valor final
            finalValueInput.value = finalValue.toFixed(2);
            });
        </script>

    </div>

    
    

</div>
@endsection