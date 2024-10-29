<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentListingController extends Controller
{
    public function index()
    {
        return inertia(
            'Agent/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
