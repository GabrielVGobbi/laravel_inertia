<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get();

        return Inertia::render('Home', [
            'users' => $users
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            'celphone' => '1197150068',
            'index' => 'Page'
        ]);
    }
}
