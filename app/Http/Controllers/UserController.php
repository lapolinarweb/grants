<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|unique:users',
            'passport' => 'required|unique:users|string',
            'address' => 'required',
            'ethereum' => 'required',
            'grant_type' => 'required',
        ]);

        $user = User::create($request->all());
        return  response()->json(null, 200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
