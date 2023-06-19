<?php

namespace App\Http\Controllers\API;

use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderAPIController extends Controller
{
    public function index() {
        $orders = Order::all();
        
        return response()->json($orders);
    }

    public function show($order_id){
        $order = Order::find($order_id);

        if ($order) {
            return response()->json($order);
        } else {
            return response()->json(['message'=>"pedido não encontrado"], 404);
        }

    }

    public function register(){
        return view('orders.register');
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'dt_order' => 'required|date_format:Y-m-d H:i:s|before:'.now(),
            'amount' => 'required|integer|gt:0',
            'status' => 'required|in:Cancelled,Pending,Completed',
            'id_product' => 'required|exists:products,id_product',
            'id_client' => 'required|exists:clients,id_client'
        ], OrderAPIController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = new Order();
        $order->dt_order = $request->dt_order;
        $order->amount = $request->amount;
        $order->id_client = $request->id_client;
        $order->id_product = $request->id_product;
        $order->status = $request->status;

        $order->save();

        return response()->json($order, 201);
    }

    public function update(Request $request, $order_id){
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['message'=>"pedido não encontrado"], 404);
        } 

        $validator = Validator::make($request->all(),[
            'dt_order' => 'date_format:Y-m-d H:i:s|before:'.now(),
            'amount' => 'integer|gt:0',
            'status' => 'in:Cancelled,Pending,Completed',
            'id_product' => 'exists:products,id_product',
            'id_client' => 'exists:clients,id_client'
        ], OrderAPIController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400
        );
        }

        $order->update($request->all());

        return response()->json($order,201);

    }

    public function destroy($order_id){
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['message'=>"pedido não encontrado"], 404);
        } 

        $order->delete();

        return response()->json(['message'=>"pedido deletado com sucesso"],201);

    }

    public function messages()
    {
        return [
            'dt_order.required' => "O campo 'dt_order' é obrigatório.",
            'dt_order.date_format' => 'A data do pedido deve estar no formato Y-m-d H:i:s.',
            'dt_order.before' => 'A data do pedido deve ser anterior à data atual.',
            'amount.required' => "O campo 'amount' é obrigatório.",
            'amount.integer' => 'A quantidade deve ser um número inteiro.',
            'amount.gt' => 'A quantidade deve ser maior que zero.',
            'status.required' => "O campo 'status' é obrigatório.",
            'status.in' => "O status deve ser 'Cancelled', 'Pending' ou 'Completed'.",
            'id_product.required' => "O campo 'id_product' é obrigatório.",
            'id_product.exists' => 'O ID do produto não existe na tabela de produtos.',
            'id_client.required' => "O campo 'id_client' é obrigatório.",
            'id_client.exists' => 'O ID do cliente não existe na tabela de clientes.',
        ];
    }

}
