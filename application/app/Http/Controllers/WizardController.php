<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WizardController extends Controller
{
    public function index()
    {
        return view('wizard');
    }
}

