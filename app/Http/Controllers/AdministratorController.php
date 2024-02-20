<?php

namespace App\Http\Controllers;

use App\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    // Create a new administrator
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:administrators',
            'password' => 'required|string|min:8',
        ]);

        $administrator = Administrator::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($administrator, 201);
    }
}
