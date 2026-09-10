<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = $request->get('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'role'      => $request->role,
            'status'    => $request->status,
        ]);

        return response()->json($user, 201);
    }
}
