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

    public function profile()
    {
        return view('pages.dashboard.profile');
    }

    public function info_profile()
    {
        $info = Auth()->user();

        return $info;
    }

    public function myProducts()
    {
        return view('pages.dashboard.usersProducts')->with('auth_user', auth()->user());
    }

    public function orderHistorys()
    {
        return view('pages.dashboard.orderHistory')->with('auth_user', auth()->user());
    }

    public function checkSales()
    {
        if (
            auth()
                ->user()
                ->hasRole('admin')
        ) {
            return view('pages.dashboard.checkSales')->with('auth_user', auth()->user());
        } else {
            return view('errors.404');
        }
    }

    public function paymentForm()
    {
        return view('pages.dashboard.paymentForm')->with('auth_user', auth()->user());
    }
}
