<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsCampaignFileUploadController extends Controller
{
    public function index()
    {
        return view('sms-campaign-file-upload.index');
    }
}

