<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();

        return view('product.list', ['products' => $products]);
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'amo_id' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|required|max:10000',
            'composition' => 'required',
            'price' => 'required',
            'wholesale' => 'required',
        ]);

        $product = new Product();

        $product->title = $request['title'];
        $product->amo_id = $request['amo_id'];
        $product->composition = $request['composition'];
        $product->price = $request['price'];
        $product->wholesale = $request['wholesale'];
        $product->weight = $request['weight'];
        $product->fat = $request['fat'];
        $product->protein = $request['protein'];
        $product->carbohydrate = $request['carbohydrate'];
        $product->kcal = $request['kcal'];
        $product->is_active = true;

        $product->image = Storage::putFile('products', $request->file('image'));

        $product->save();

        return redirect('/admin/products')->with(['message' => 'Успешно добавлено', 'alert' => 'alert-success']);
    }

    public function edit($id){

        $product = Product::find($id);

        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, $id){

        $product = Product::find($id);

        $request->validate([
            'title' => 'required',
            'amo_id' => 'required',
            'composition' => 'required',
            'price' => 'required',
            'wholesale' => 'required',
        ]);

        $product->title = $request['title'];
        $product->amo_id = $request['amo_id'];
        $product->composition = $request['composition'];
        $product->price = $request['price'];
        $product->wholesale = $request['wholesale'];
        $product->weight = $request['weight'];
        $product->fat = $request['fat'];
        $product->protein = $request['protein'];
        $product->carbohydrate = $request['carbohydrate'];
        $product->kcal = $request['kcal'];

        if ($request->has('image')){
            Storage::delete($product->image);
            $product->image = Storage::putFile('products', $request->file('image'));
        }

        $product->save();

        return redirect('/admin/products')->with(['message' => 'Успешно обновлено', 'alert' => 'alert-success']);
    }

    public function deactivate($id) {
        $product = Product::find($id);

        $product->is_active = false;
        $product->save();

        return redirect('/admin/products')->with(['message' => 'Успешно деактивирован', 'alert' => 'alert-success']);
    }

    public function activate($id) {
        $product = Product::find($id);

        $product->is_active = true;
        $product->save();

        return redirect('/admin/products')->with(['message' => 'Успешно активирован', 'alert' => 'alert-success']);
    }
}
