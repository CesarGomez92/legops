<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Mail\RegisteredUser;
use App\Mail\UsersByCountry;
use App\Models\Categories\Category;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $categories = Category::all();

        return view('users.create', ['categories' => $categories]);
    }

    public function store()
    {
        request()->validate([
                                        'first_name' => 'required|min:5|max:100|alpha',
                                        'last_name' => 'required|max:100|alpha',
                                        'identification' => 'required|unique:users|',
                                        'email' => 'required|email|unique:users|max:150',
                                        'address' => 'required|max:180',
                                        'cell_phone' => 'required|numeric|integer'
                                    ]);
        
        $data = request()->all();
        
        $user = User::create($data);

        Mail::to($user->email)->send(new RegisteredUser());
        
        $admin_mail = env('MAIL_ADMIN_REPORTS', 'cesar@legops.com');
        Mail::to($admin_mail)->send(new UsersByCountry());
        
        return 200;
        
    }

    public function edit(User $user)
    {
        $categories = Category::all();
        
        return view('users.edit', ['user' => $user, 'categories' => $categories]);
    }

    public function destroy(User $user)
    {
        $results = [];
        
        $user->delete();
        
        $results['status'] = 'success';
        
        return $results;
    }
}
