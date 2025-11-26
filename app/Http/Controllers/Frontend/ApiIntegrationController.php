<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiIntegrationController extends Controller
{
    public function payment()
    {
        return view('backend.admin.api.payment');
    }
}
