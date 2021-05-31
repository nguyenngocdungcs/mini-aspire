<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\User;
use App\Http\Responses\APIResponse;

class UserController extends Controller
{
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());
        return APIResponse::success($user);
    }

    public function index()
    {
        $query = User::query();
        $this->queryFilter($query, ['name', 'email']);
        $items = $query->paginate();
        return APIResponse::success($items);
    }

    public function show(User $user)
    {
        return APIResponse::success($user);
    }
}
