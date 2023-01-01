<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;


class ordersController extends Controller
{
    public function index(Request $request){
        
        $orders = Order::whereHas('client',function($q) use ($request){
            return $q->where('name','like','%'. $request->search . '%');
        })->paginate(10);
        return view('dashboard.orders.index',compact('orders'));
    }

    public function products(Order $order){

        $products = $order->products;
        return view('dashboard.orders._products',compact('order', 'products'));

    }

    public function destroy(Order $order){
       // dd($order->products->first()->pivot->quantity); => 3la4an azawed quantity

       foreach($order->products as $product){

        $product->update([
            'stock' => $product->stock + $product->pivot->quantity,
        ]);
       }
        $order->delete();
        return redirect()->route('dashboard.orders.index')->with('success',__('site.deleted_successfully'));

    }


























}
