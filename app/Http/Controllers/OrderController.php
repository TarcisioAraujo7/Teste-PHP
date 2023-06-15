<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {

        $orders = Order::all();
        
        $show_all = false;
        $show_one = false;

        return view('orders.viewer', compact('show_all','show_one','orders'));
    }

    public function showAll(Request $request) {
        $id_client = $request->id_client;
        $id_product = $request->id_product;
        $status = $request->status;

        $orders = OrderController::return_filtragem($id_client, $id_product, $status);

        $show_all = true;
        $show_one = false;

        return view('orders.viewer', compact('show_all','show_one','orders'));
        
    }

    public function show(Request $request){
        $id_order = $request->input('id_order');
        $orders = Order::find($id_order);

        if (!$orders) {
            $messages = "Error! Não foi encontrado pedido com esse ID.";
            return view('layouts.error', compact('messages'));
        }

        $show_all = false;
        $show_one = true;

        return view('orders.viewer', compact('show_all', 'show_one', 'orders'));
        

    }

    public function form_post() {

        return view('orders.register');
        
    }

    public function store(Request $request){
        
        $request->merge([
            'dt_order' => str_replace('T', ' ', $request->input('dt_order')),
        ]);

        $validator = Validator::make($request->all(),[
            'dt_order' => 'required|date_format:Y-m-d H:i|before:'.now(),
            'amount' => 'required|integer|gt:0',
            'status' => 'required|in:Cancelled,Pending,Completed',
            'id_product' => 'required|exists:products,id_product',
            'id_client' => 'required|exists:clients,id_client'
        ], OrderController::messages());
        
        if ($validator->fails()) {
            return OrderController::return_erro($validator->errors());
        }

        $order = new Order();
        $order->dt_order = $request->dt_order;
        $order->amount = $request->amount;
        $order->id_client = $request->id_client;
        $order->id_product = $request->id_product;
        $order->status = $request->status;

        $order->save();

        $title = "Sucesso!";
        $messages = "Pedido adicionado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }

    public function selec_put() {

        return view('orders.seletor');
        
    }   

    public function form_put(Request $request) {
        $order = Order::find($request->input('id_order'));

        if (!$order) {
            return OrderController::return_erro("Cliente não encontrado com o ID informado");
        }

        return view('orders.updater',compact('order'));
    }

    public function update(Request $request, $order_id){
        $order = Order::find($order_id);

        if (!$order) {
            return OrderController::return_erro("Pedido não encontrado com o ID informado");
        } 

        if ($request -> dt_order) {
            $request->merge([
                'dt_order' => str_replace('T', ' ', $request->input('dt_order')),
            ]);
        }

        $validator = Validator::make($request->all(),[
            'dt_order' => 'date_format:Y-m-d H:i|before:'.now(),
            'amount' => 'integer|gt:0',
            'status' => 'in:Cancelled,Pending,Completed',
            'id_product' => 'exists:products,id_product',
            'id_client' => 'exists:clients,id_client'
        ], OrderController::messages());
        
        if ($validator->fails()) {
            return OrderController::return_erro($validator->errors());
        }

        $order->update($request->all());

        $title = "Sucesso";
        $messages = "Pedido alterado com sucesso!";
        return view('layouts.message', compact('title','messages'));

    }

    public function selec_del() {

        return view('orders.selecDelete');
        
    }

    public function selec_massdel() {

        $orders = Order::all();

        return view('orders.massDeleter', compact('orders'));
        
    }

    public function massdel(Request $request) {
        foreach ($request->all() as $key => $value) {

            if ($key == '_token' ||$key == '_method'  ) {
                continue;
                
            } else {

                try {
                    Order::destroy($value);
                } catch (\Illuminate\Database\QueryException $e) {
                    return OrderController::return_erro("Ocorreu um erro ao excluir o pedido.");
                }

            }
        }
        
        $title = "Sucesso!";
        $messages = "Todos pedidos foram deletados com sucesso!";
        return view('layouts.message', compact('title','messages'));
        
    }


    public function confirm_destroy(Request $request) {
        $order = Order::find($request->input('id_order'));

        if (!$order) {
            return OrderController::return_erro("Pedido não encontrado com o ID informado");
        }

        return view('orders.confirmDelete',compact('order'));
    }

    public function destroy($order_id){
        $order = Order::find($order_id);

        if (!$order) {
            return OrderController::return_erro("Pedido não encontrado com o ID informado");
        } 

        try {
            $order->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return OrderController::return_erro("Não é possível excluir o pedido devido a registros dependentes em outras tabelas.");
            } else {
                return OrderController::return_erro("Ocorreu um erro ao excluir o pedido.");
            }
        }
        
        $title = "Sucesso!";
        $messages = "Pedido deletado com sucesso!";
        return view('layouts.message', compact('title','messages'));

    }

    public function return_filtragem($id_client, $id_product, $status){
        
        $query = Order::query();
        
        if (!$id_client && !$id_product && !$status) {
            $orders = Order::all();
            return $orders;
        }

        if ($id_client) {
            $query->where('id_client', $id_client);
        }
        if ($id_product) {
            $query->where('id_product', $id_product);
        }
        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->get();

        return $orders;
    }


    public function return_erro($messages){
        return view('layouts.error', compact('messages'));
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
