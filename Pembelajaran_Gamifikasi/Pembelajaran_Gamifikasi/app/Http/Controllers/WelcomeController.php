<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class WelcomeController extends Controller
{
    public function index()
    {
        $materials = Material::take(6)->get();
        return view('welcome', compact('materials'));
    }
}