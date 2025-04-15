<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function updateContact(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('first_name', 'last_name', 'contact_number', 'email', 'isAdmin'));
        return response()->json(['message' => 'Contact updated', 'user' => $user]);
    }

    public function searchContacts(Request $request)
    {
        $query = $request->input('query');
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $users = User::where('first_name', 'LIKE', "%$query%")
            ->orWhere('last_name', 'LIKE', "%$query%")
            ->orWhere('contact_number', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->paginate($perPage);
        return response()->json($users);
    }

    public function listAccounts(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $users = User::paginate($perPage);
        return response()->json($users);
    }
}