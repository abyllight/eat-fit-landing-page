<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $products = Product::all();

        return view('admin', ['products' => $products]);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'composition' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'priceP' => 'required',
            'front' => 'image|mimes:jpeg,jpg,png|required|max:10000',
            'back' => 'image|mimes:jpeg,jpg,png|required|max:10000',
        ]);

        $product = new Product();

        $product->title = $request['title'];
        $product->composition = $request['composition'];
        $product->weight = $request['weight'];
        $product->price = $request['price'];
        $product->price_per_item = $request['priceP'];
        $product->qty = 1;
        $product->total = $request['price'];
        $product->is_active = true;
        $product->image_front_url = uniqid() . '_' .$request->file('front')->getClientOriginalName();
        $product->image_back_url = uniqid() . '_' .$request->file('back')->getClientOriginalName();

        $request->file('front')->storeAs('public', $product->image_front_url);
        $request->file('back')->storeAs('public', $product->image_back_url);

        $product->save();

        return redirect('/admin')->with(['message' => 'Успешно добавлено', 'alert' => 'alert-success']);
    }

    public function edit($id){

        $product = Product::find($id);

        return view('edit', ['product' => $product]);
    }

    public function update(Request $request, $id){

        $product = Product::find($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'composition' => 'required',
            'weight' => 'required',
            'price' => 'required',
            'priceP' => 'required',

            'front' => $request->has('front') ? 'image|mimes:jpeg,jpg,png|required|max:10000' : '',
            'back' => $request->has('back') ? 'image|mimes:jpeg,jpg,png|required|max:10000' : '',
        ]);

        $product->title = $request['title'];
        $product->composition = $request['composition'];
        $product->weight = $request['weight'];
        $product->price = $request['price'];
        $product->price_per_item = $request['priceP'];
        $product->qty = 1;
        $product->total = $request['price'];

        $product->is_active = $request['active'] === 'on' ? true : false;
        if ($request->has('front')){
            $product->image_front_url = uniqid() . '_' .$request->file('front')->getClientOriginalName();
            $request->file('front')->storeAs('public', $product->image_front_url);
        }

        if ($request->has('back')) {
            $product->image_back_url = uniqid() . '_' . $request->file('back')->getClientOriginalName();
            $request->file('back')->storeAs('public', $product->image_back_url);
        }

        $product->save();

        return redirect('/admin')->with(['message' => 'Успешно обновлено', 'alert' => 'alert-success']);
    }
}
