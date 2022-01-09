<?php

namespace App\Http\Controllers;

use App\Models\Shepherd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShepherdController extends Controller
{

    protected $user;
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
        $this->user = new User();
    }

    public function getShepherds()
    {
        return Shepherd::with('parishes')->get();
    }

    public function store(Request $request)
    {
        // echo Auth::user()->id;
        // validating data
        $request->validate($this->validateData());

        $requested_data = $request->all();
        // //new instantiation of model parish
        $new_shepherd = new Shepherd();
        $new_shepherd->full_name = $requested_data['full_name'];
        $new_shepherd->email = $requested_data['email'];
        $new_shepherd->phone = $requested_data['phone'];
        $new_shepherd->address = $requested_data['address'];
        $new_shepherd->user_id = Auth::user()->id;
        // saving data parish
        $new_shepherd->save();

        if (isset($requested_data['parishes'])) {
            $new_shepherd->parishes()->sync($requested_data['parishes']);
        }

        return response()->json([
            'message' => 'Berger sauvagerder avec success',
            'success' => true,
            'data' => $new_shepherd
        ]);
    }

    public function validateData()
    {
        return [
            'full_name' => 'required|string',
            'email' => 'required|string|unique:shepherds',
            'address' => 'required|string',
            'phone' => 'required|string',
        ];
    }
}
