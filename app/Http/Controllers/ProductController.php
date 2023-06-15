<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $products = []; 

        $show_all = false;
        $show_one = false;

        return view('products.viewer', compact('show_all','show_one','products'));
    }

    public function show_all(Request $request) {

        $like_name = $request->like_name;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;

        $products = ProductController::return_filtragem($like_name, $minPrice, $maxPrice);

        $show_all = true;
        $show_one = false;

        return view('products.viewer', compact('show_all','show_one','products'));
        
    }

    public function show(Request $request)
    {
        $id_product = $request->input('id_product');
        $products = product::find($id_product);

        if (!$products) {
            $messages = "Error! Não foi encontrado produto com esse ID.";
            return view('layouts.error', compact('messages'));
        }

        $show_all = false;
        $show_one = true;

        return view('products.viewer', compact('show_all', 'show_one', 'products'));
    }

    public function form_post() {

        return view('products.register');
        
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name_product' => 'required|max:30',
            'unitary_value' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'bar_code' => 'required|regex:/^[0-9]+$/|size:10|unique:products',
        ], ProductController::messages());
        
        if ($validator->fails()) {
            return ProductController::return_erro($validator->errors());
        }

        $product = new Product();
        $product->name_product = $request->name_product;
        $product->unitary_value = $request->unitary_value;
        $product->bar_code = $request->bar_code;

        $product->save();

        $title = "Sucesso!";
        $messages = "Produto adicionado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }

    public function selec_put() {

        return view('products.seletor');
        
    }

    public function form_put(Request $request) {
        $product = Product::find($request->input('id_product'));

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        }

        return view('products.updater',compact('product'));
    }

    public function update(Request $request, $product_id){

        $product = Product::find($product_id);

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        } 

        $validator = Validator::make($request->all(),[
            'name_product' => 'max:30',
            'unitary_value' => 'numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'bar_code' => 'regex:/^[0-9]+$/|size:10',
        ], ProductController::messages());
        
        $validator->sometimes('bar_code', 'unique:products', function ($input) use ($product) {
            return $input->bar_code != $product->bar_code;
        });

        if ($validator->fails()) {
            return ProductController::return_erro($validator->errors());
        }

        $product->update($request->all());

        $title = "Sucesso";
        $messages = "Produto alterado com sucesso!";
        return view('layouts.message', compact('title','messages'));

    }

    public function selec_del() {

        return view('products.selecDelete');
        
    }

    public function selec_massdel() {

        $products = Product::all();

        return view('products.massDeleter', compact('products'));
        
    }

    public function massdel(Request $request) {
        foreach ($request->all() as $key => $value) {

            if ($key == '_token' || $key == '_method'  ) {
                continue;
                
            } else {

                try {
                    Product::destroy($value);
                } catch (\Illuminate\Database\QueryException $e) {
                    $errorCode = $e->errorInfo[1];
                    if ($errorCode == 1451) {
                        return ProductController::return_erro("Não é possível excluir o produto de id {$value} devido a registros dependentes em outras tabelas.");
                    } else {
                        return ProductController::return_erro("Ocorreu um erro ao excluir o produto.");
                    }
                }

            }
        }
        
        $title = "Sucesso!";
        $messages = "Todos produtos foram deletados com sucesso!";
        return view('layouts.message', compact('title','messages'));
        
    }

    public function confirm_destroy(Request $request) {
        $product = Product::find($request->input('id_product'));

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        }

        return view('products.confirmDelete',compact('product'));
    }

    public function destroy($product_id){
        $product = Product::find($product_id);

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        }

        try {
            $product->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return ProductController::return_erro("Não é possível excluir o produto devido a registros dependentes em outras tabelas.");
            } else {
                return ProductController::return_erro("Ocorreu um erro ao excluir o produto.");
            }
        }
        
        $title = "Sucesso!";
        $messages = "Produto deletado com sucesso!";
        return view('layouts.message', compact('title','messages'));

    }

    public function selec_promo(){
        return view("products.selecPromo");
    }

    public function confirm_promo(Request $request){
        $product = Product::find($request->input('id_product'));

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        }

        return view('products.confirmPromo',compact('product'));
    }

    public function update_value(Request $request, $id_product){
        
        $product = Product::find($id_product);

        if (!$product) {
            return ProductController::return_erro("Produto não encontrado com o ID informado");
        }     
        
        if ($request->final_value <= 0) {
            return ProductController::return_erro("O valor final não pode ser menor ou igual a zero!");
        }

        $product->unitary_value = $request->final_value;;

        $product->update();

        $title = "Sucesso!";
        $messages = "Produto alterado com sucesso!";
        return view('layouts.message', compact('title','messages'));
    }

    public function return_filtragem($like_name, $minPrice, $maxPrice){
        
        $query = Product::query();
        
        if (!$like_name && !$minPrice && !$maxPrice) {
            $products = Product::all();

            return $products;
        }

        if ($like_name) {
            $query->where('name_product', 'LIKE', '%' . $like_name . '%');
        }
        if ($minPrice && $maxPrice) {
            $query->whereBetween('unitary_value', [$minPrice, $maxPrice]);
        } elseif ($minPrice) {
            $query->where('unitary_value',  '>', $minPrice);
        } elseif ($maxPrice){
            $query->where('unitary_value',  '<', $maxPrice);
        }

        $products = $query->get();

        return $products;
    }

    public function return_erro($messages){
        return view('layouts.error', compact('messages'));
    }


    public function messages() 
    {
        return [
            'name_product.required' => "O campo 'name_product' é obrigatório.",
            'name_product.max' => 'O campo nome do produto não pode exceder 30 caracteres.',
            'unitary_value.required' => "O campo 'unitary_value' é obrigatório.",
            'unitary_value.numeric' => 'O campo valor unitário deve ser um número.',
            'unitary_value.gt' => 'O campo valor unitário deve ser maior que 0.',
            'unitary_value.regex' => 'O campo valor unitário deve ter até 2 casas decimais.',
            'bar_code.required' => "O campo 'bar_code' é obrigatório.",
            'bar_code.regex' => 'O campo código de barras deve conter apenas números.',
            'bar_code.size' => 'O campo código de barras deve ter exatamente 10 caracteres.',
            'bar_code.unique' => 'O código de barras informado já está cadastrado.',
        ];
    }

}
