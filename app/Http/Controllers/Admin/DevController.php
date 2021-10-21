<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DevController extends Controller
{
    public function index()
    {
        $this->checkGate('dev_documentation_access');
        return view('admin.documentation');
    }
}
