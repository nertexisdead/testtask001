<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        return view('index', [
            //
        ]);
    }

    public function dashboard(): View
    {
        return view('dashboard', [
            //
        ]);
    }
}
