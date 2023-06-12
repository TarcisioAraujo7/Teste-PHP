<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $products = Product::all();
        
        return response()->json($products);
    }

    public function show($product_id){
        $product = Product::find($product_id);

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message'=>"produto não encontrado"], 404);
        }

    }

    public function register(){
        return view('products.register');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name_product' => 'required|max:30',
            'unitary_value' => 'required|numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'bar_code' => 'required|regex:/^[0-9]+$/|size:10|unique:products',
        ], ProductController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = new Product();
        $product->name_product = $request->name_product;
        $product->unitary_value = $request->unitary_value;
        $product->bar_code = $request->bar_code;

        $product->save();

        return response()->json($product, 201);
    }

    public function update(Request $request, $product_id){
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message'=>"produto não encontrado"], 404);
        } 

        $validator = Validator::make($request->all(),[
            'name_product' => 'max:30',
            'unitary_value' => 'numeric|gt:0|regex:/^\d+(\.\d{1,2})?$/',
            'bar_code' => 'regex:/^[0-9]+$/|size:10|unique:products',
        ], ProductController::messages());
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product->update($request->all());

        return response()->json($product,201);

    }

    public function destroy($product_id){
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message'=>"produto não encontrado"], 404);
        } 

        $product->delete();

        return response()->json(['message'=>"produto deletado com sucesso"],201);

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
