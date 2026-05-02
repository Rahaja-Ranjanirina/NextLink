<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // On importe le modèle Admin

class WelcomeController extends Controller
{
    public function index()
    {
        $admin = Admin::first();
        return view('welcome', compact('admin'));
    }
}
