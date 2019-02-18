<?php

namespace App\Http\Controllers;

use App\Client;
use App\Sale;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use RegistersUsers;

    public function index()
    {
        
    }
    public function createUser(Request $request){
         User::create([
            'name' => $request->client['name'],
            'email' => $request->client['email'],
            'lastname' => $request->client['lastname'],
            'rut' => $request->client['rut'],
            'address' => $request->client['address'],
            'company' => $request->client['company'],
            'company_rut' => $request->client['company_rut'],
            'discount' => $request->client['discount'],
            'privileges' => $request->client['privileges'],
            'password' => Hash::make($request->client['password']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newClient = new Client;

        $newClient->name = $request->name;
        $newClient->rut = $request->rut;
        $newClient->email = $request->email;
        $newClient->address = $request->address;
        $newClient->company = $request->company;
        $newClient->company_rut = $request->companyRut;
        $newClient->discount = $request->discount;
        $newClient->password = Hash::make($request->password);
        $newClient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function getClients(){
        $client = User::where('id', '!=', 1)->get();
        return $client;
    }

    public function show(Client $client)
    {
        $products = Client::all();
        return $products;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function getClient(Request $request){
        $client = User::where('id', $request->id)->get();
        return $client;
    }

    public function updateClient(Request $request){
        $user = User::find($request->id);

        $user->name = $request->data['name'];
        $user->rut = $request->data['rut'];
        $user->email = $request->data['email'];
        $user->address = $request->data['address'];
        $user->company = $request->data['company'];
        $user->company_rut = $request->data['company_rut'];
        $user->discount = $request->data['discount'];
        $user->password = $request->data['password'] != null ? Hash::make($request->data['password']) : $user->password;
        $user->save();
    }

    public function edit(Client $client)
    {
        //
    }

    public function detailsClient(Request $request){
        $user = User::find($request->id);
        //$data = Sale::where('client', 'Anais')->get(); 
        if($user->privileges == 'Ventas'){
            $type = 'Vendedor';
            $data = Sale::where('seller', $user->name)->get();
        } 
        else if($user->privileges == 'Cliente'){
            $type = 'Cliente';
            $data = Sale::where('client', $user->name)->get(); 
        }

        return [$user, $type, $data];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = User::find($id);
        $post->delete();
    }
}
