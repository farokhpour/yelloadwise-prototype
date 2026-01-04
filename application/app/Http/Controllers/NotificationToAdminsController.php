<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationToAdminsController extends Controller
{
    public function index()
    {
        return view('notification-to-admins.index');
    }
}

