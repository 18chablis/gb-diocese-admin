<?php

namespace App\Http\Controllers;

use App\Models\Parish;
use App\Models\Shepherd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParishController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", "register"]]);
        $this->user = new User();
    }

    public function getParishes()
    {
        return Parish::with('shepherds')->get();
    }

    public function store(Request $request)
    {
        // echo Auth::user()->id;
        // validating data
        $request->validate($this->validateData());

        $requested_data = $request->all();
        // //new instantiation of model parish
        $new_parish = new Parish();
        $new_parish->parish_name = $requested_data['parish_name'];
        $new_parish->parish_address = $requested_data['parish_address'];
        $new_parish->user_id = Auth::user()->id;
        // saving data parish
        $new_parish->save();

        if (isset($requested_data['shepherds'])) {
            $new_parish->shepherds()->sync($requested_data['shepherds']);
        }

        return response()->json([
            'message' => 'Paroisse sauvagerder avec success',
            'success' => true,
            'data' => $new_parish
        ]);
    }

    public function validateData()
    {
        return [
            'parish_name' => 'required|string',
            'parish_address' => 'required|string',
        ];
    }
}
