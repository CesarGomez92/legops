<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Categories\Category;

class UsersActionsController extends Controller
{
    public function getAllUsers()
    {
        $results = [];
        
        $users = User::all();
        $users->each->load('category');
        
        $results['users'] = $users;
        
        return $results;
    }

    public function searchUsers()
    {
        $results = [];
        
        $search_key = request()->get('search_key');
        
        $query = User::where('first_name', 'like', '%' . $search_key . '%')->orWhere('last_name', 'like', '%' . $search_key . '%')
                        ->orWhere('email', 'like', '%' . $search_key . '%')->orWhere('identification', 'like', '%' . $search_key . '%');
        
        $users = $query->with('category')->get();
        
        $results['users'] = $users;
        
        return $results;
    }
}
