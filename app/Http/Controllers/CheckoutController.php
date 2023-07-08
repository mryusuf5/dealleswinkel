<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!Session::has("cart"))
        {
            return redirect()->route("home");
        }
        return view('user.checkout.index');
    }
}
