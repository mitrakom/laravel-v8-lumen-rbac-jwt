<?php

namespace App\Http\Controllers;

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
        $this->middleware('role:admin|user');
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    }

    public function tes() {
        return auth()->user()->getRoleNames();
        // return [453];
    }
}
