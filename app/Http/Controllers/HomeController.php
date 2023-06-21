<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data['products_featured'] = Product::all();
        return view('home', $data);
    }

    public function shop()
    {
        $data['products'] = Product::all();
        return view('shop', $data);
    }

    public function product($slug)
    {
        $data['product'] = Product::where('slug', $slug)->first();
        return view('product', $data);
    }

    public function category($slug)
    {
        return view('category');
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function cart()
    {
        $data['carts'] = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart', $data);
    }

    public function cartadd(Request $request)
    {
        Cart::create([
            'user_id'     => Auth::user()->id,
            'product_id'  => $request->product_id,
            'quantity'    => $request->quantity,
            'total_price' => $request->price * $request->quantity,
        ]);

        return redirect()->route('cart');
    }

    public function cartdelete(Request $request)
    {
        Cart::findOrFail($request->id)->delete();

        return redirect()->route('cart');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if (count($carts) == 0) {
            return redirect()->route('cart');
        }

        $data['carts'] = $carts;
        return view('checkout', $data);
    }
}
