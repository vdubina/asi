<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\SampleRepositoryInterface;

class HomeController
{
    public function index(SampleRepositoryInterface $sampleRepository)
    {
        // $sampleRepository->all()
        return view('home');
    }
}
