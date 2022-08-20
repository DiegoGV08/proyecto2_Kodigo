<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::paginate(5);
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
                'email' => 'required|string',
                'username' => 'required|string',
                'password' => 'required|string',
            ]
        );

        $user = new User();


        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);

        $user ->save();
        return response()->json(
            [
                'message' => 'user saved correctly',
                'data' => $user
            ]);

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
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['message' => 'user not found'], 404);
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
    public function update($id, Request $request)
    {


        $user = User::find($id);
        if ($user) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|string',
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
            if($validator->fails()){
                return response()->json(['message' => 'malformed request syntax'], 400);
            }
            else{
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->username = $request->username;
                $user->password = bcrypt($request->password);

                $user->save();
                return response()->json(['message' => 'user edited correctly', 'data' => $user]);
            }
        } else {
            return response()->json(['message' => 'user not found'], 404);
        }

        //
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'user deleted correctly']);
        }
        return response()->json(['message' => 'user not found'], 404);
    }
}
