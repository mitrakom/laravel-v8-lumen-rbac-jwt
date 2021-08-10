<?php

namespace App\Http\Controllers;

use App\Models\User;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('role:user');
        // $this->middleware('role:admin|user');
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    }

    public function getRole() {
        return auth()->user()->getRoleNames();
        // return auth()->user()->getRoleNames()->first();
        // return User::doesntHave('roles')->get();
    }

    public function isAdmin() {
        return auth()->user()->getRoleNames();
    }
}
