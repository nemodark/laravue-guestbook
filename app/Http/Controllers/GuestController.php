<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function index()
    {
        return response(Guest::all()->toJson());
    }


    public function show($id)
    {
        $guest = Guest::find($id);
        return response()->json($guest);    
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }

        Guest::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

        return response()->json('success');
    }

    public function update(Request $request, $id) 
    {
        $validate = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);

        if($validate->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }

        $guest = Guest::find($id);

        $guest->firstname = $request->firstname;
        $guest->lastname = $request->lastname;
        $guest->email = $request->email;
        $guest->country_code = $request->country_code;
        $guest->phone_number = $request->phone_number;
        $guest->gender = $request->gender;
        $guest->address = $request->address;
        $guest->save();
        
        return response()->json('success');
    }

    public function delete($id)
    {
        $guest = Guest::find($id);
        $guest->delete();
        return response()->json('success');
    }
}
