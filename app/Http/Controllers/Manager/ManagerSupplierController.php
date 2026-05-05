<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerSupplierController extends Controller
{
    public function index()
    {
        return view('pages.manager.supplier');
    }
}