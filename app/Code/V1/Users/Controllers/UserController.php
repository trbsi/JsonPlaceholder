<?php

namespace App\Code\V1\Users\Controllers;

use App\Code\V1\Users\Services\UsersFetcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController
{
    public function getUsers(Request $request, UsersFetcher $usersFetcher)
    {
        $users = $usersFetcher->fetchUsers((int) $request->id, $request->email);

        return response()->json($users);
    }
}