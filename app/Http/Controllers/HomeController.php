<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.dashboard.dashboard');
    }

    public function products()
    {
        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            return view('pages.dashboard.management.products');
        } else {
            return view('errors.404');
        }
    }

    public function users()
    {
        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            return view('pages.dashboard.management.users');
        } else {
            return view('errors.404');
        }
    }
}
