<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function createAccount()
    {
        return view('admin.accounts.create');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account created');
    }

    public function listAccounts(Request $request)
    {
        $query = $request->input('query');
        $users = User::when($query, function ($q) use ($query) {
            $q->where('first_name', 'LIKE', "%$query%")
              ->orWhere('last_name', 'LIKE', "%$query%")
              ->orWhere('contact_number', 'LIKE', "%$query%")
              ->orWhere('email', 'LIKE', "%$query%");
        })->paginate(10);

        return view('admin.accounts.index', compact('users', 'query'));
    }
}