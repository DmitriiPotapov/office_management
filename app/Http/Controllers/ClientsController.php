<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return view('clients/all_clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients/add_client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $client_name = $request->client_name;
        $pib_jmbg = $request->pib_jmbg;
        $street = $request->street;
        $number = $request->number;
        $apt = $request->apt;
        $postal_code = $request->postal_code;
        $pak = $request->pak;
        $city_name = $request->city_name;
        $country = $request->country;
        $ui_language = $request->ui_language;
        $email_value = $request->email_value;
        $email_name = $request->email_name;
        $phone_value = $request->phone_value;
        $phone_name = $request->phone_name;
        $client_note = $request->client_note;
        $company = $request->company;
        $client_group = $request->client_group;
        
        $client = new Client();
        $client->client_name = $client_name;
        $client->pib_jmbg = $pib_jmbg;
        $client->street = $street;
        $client->number = $number;
        $client->apt = $apt;
        $client->postal_code = $postal_code;
        $client->pak = $pak;
        $client->city_name = $city_name;
        $client->country = $country;
        $client->ui_language = $ui_language;
        $client->email_value = $email_value;
        $client->email_name = $email_name;
        $client->phone_value = $phone_value;
        $client->phone_name = $phone_name;
        $client->client_note = $client_note;
        $client->company = $company;
        $client->client_group = $client_group;

        $client->save();

        if($request->submitType == 0) {
            $clients = Client::all();
            return view('clients/all_clients', compact('clients'));
        }else{
            return redirect('job/showAddJob');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Client::find($id)->delete();

        return redirect(route('allclients'));
    }

    public function reset(){

       return redirect()->back();
    }
}
