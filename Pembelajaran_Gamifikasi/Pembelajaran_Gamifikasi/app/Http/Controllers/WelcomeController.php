<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('levels')->get();
        
        return view('welcome', compact('categories'));
    }
}