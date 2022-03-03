<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Categories\Category;

class UsersController extends Controller
{
    public function index()
    {
               
        $categories = Category::all();
        
        return view('users.index', ['categories' => $categories]);
    }

    public function getAllUsers()
    {
        $users = User::all();
    }
}
