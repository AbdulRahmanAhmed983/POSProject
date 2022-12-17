<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Client;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    
    public function index()
    {
        
    }

   
    public function create(Client $client,Order $order)
    {        
        $orders = Order::paginate(5);
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create',compact(['client','categories','orders']));
    }

 
    public function store(Request $request,Client $client)
    {
        
    }
  
    public function edit(Client $client,Order $order)
    {
        
    }

    
    public function update(Request $request, Client $client,Order $order)
    {
        
    }

  
    public function destroy(Client $client,Order $order)
    {
        
    }
}
