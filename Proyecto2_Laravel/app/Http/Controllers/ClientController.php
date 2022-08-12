<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Client::paginate(5);
        return response()->json($data);
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
        //
        $request->validate(
            [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'identification_number' => 'required|string',
                'email' => 'required|string',
                'telephone_number' => 'required|string',
                'birth_date' => 'required|string',
                'address' => 'required|string',
                'password' => 'required|string',
                'client_state' => 'required|boolean'
            ]
        );

        if ($request->id) {
            $client = Client::find($request->id);
        } else {
            $client = new Client();
        }

        $client->name = $request->name;
        $client->last_name = $request->last_name;
        $client->identification_number = $request->identification_number;
        $client->email = $request->email;
        $client->telephone_number = $request->telephone_number;
        $client->birth_date = $request->birth_date;
        $client->address = $request->address;
        $client->password = $request->password;
        $client->client_state = $request->client_state;

        $client->save();
        return response()->json(
            [
                'message' => 'client saved correctly',
                'data' => $client
            ]
        );
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
        $client = Client::find($id);
        if ($client) {
            return response()->json($client);
        }
        return response()->json(['message' => 'client not found'], 404);
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
        $client = Client::find($id);
        if ($client) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'identification_number' => 'required|string',
                'email' => 'required|string',
                'telephone_number' => 'required|string',
                'birth_date' => 'required|string',
                'address' => 'required|string',
                'password' => 'required|string',
                'client_state' => 'required|boolean'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => 'malformed request syntax'], 400);
            } else {
                $client->name = $request->name;
                $client->last_name = $request->last_name;
                $client->identification_number = $request->identification_number;
                $client->email = $request->email;
                $client->telephone_number = $request->telephone_number;
                $client->birth_date = $request->birth_date;
                $client->address = $request->address;
                $client->password = $request->password;
                $client->client_state = $request->client_state;

                $client->save();
                return response()->json(['message' => 'client edited correctly', 'data' => $client]);
            }
        } else {
            return response()->json(['message' => 'client not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return response()->json(['message' => 'client delete correctly']);
        }
        return response()->json(['message' => 'client not found'], 404);
    }
}
