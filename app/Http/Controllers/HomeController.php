<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $user = Auth::user();
        return view('user.home', compact('produks', 'user'));
    }

    public function login($id)
    {
        $user = User::findorFail($id);
        $produks = Produk::all();
        return view('user.home', compact('user', 'produks'));
    }

    public function produk($id)
    {
        $user = User::findorFail($id);
        $produks = Produk::all();
        return view('user.produk', compact('user', 'produks'));
    }
}
