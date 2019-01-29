<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return $clients;
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

    public function initSession(Request $request){
        
    }

    public function getHome(){
        return view('client');
        /* $actualUser = Client::where('email', $request->email)->get();


        if (Hash::check( $request->password, $actualUser->password )) {
            print_r ('es la misma');
            return true;
        } else{
            print_r ('no es la misma');
            return false;
        } */
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
        $newClient->password =  Hash::make($request->password);
        $newClient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
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
    public function destroy(Client $client)
    {
        //
    }
}
