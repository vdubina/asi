<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\SampleRepositoryInterface;

class HomeController
{
    public function index()
    {
        return view('home');
    }
}
