<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
class ClientController extends Controller
{
 
    public function index(Request $request)
    {
        $clients = Client::when($request->search,function($query) use($request){
             return $query->where('name','like','%'.$request->search. '%')->orWhere
             ('phone','like','%'.$request->search. '%')->orWhere('address','like','%'.$request->search. '%');
        })->latest()->paginate(10);
        return view('dashboard.clients.index',compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');

    }

   
    public function store(ClientRequest $request)
    {
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone); 
       // dd($request_data);
        Client::create($request_data);
        return redirect()->route('dashboard.clients.index')->with('success',__('site.added_successfully'));

    }

    
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit',compact('client'));

    }

    public function update(ClientRequest $request, Client $client)
    {
        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone); 
        $client->update($request_data);
        return redirect()->route('dashboard.clients.index')->with('success',__('site.updated_successfully'));

    }

   
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('dashboard.clients.index')->with('success',__('site.deleted_successfully'));

    }
}
